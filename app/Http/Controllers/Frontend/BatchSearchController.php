<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Jobs\GetUserDetails;
use App\traits\UsersDetails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BatchSearchController extends FrontendController
{
    use UsersDetails;

    /**
     * Holds GetUserDetails job instance.
     *
     * @var
     */
    protected $userDetailsQueue = null;

    /**
     * Collect users from post and search for details in database
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postSearch()
    {
        $this->data['page_title'] = 'Search Post';

        return view('batch_search.search_post', $this->data);
    }


    /**
     * Receiving users IDs and Username(s) from API and send it to the
     * queuing system.
     *
     * @param Request $request
     * @return mixed
     */
    public function CollectFromPost(Request $request)
    {
        // Calling GetUserDetails job and run queue in the background
        GetUserDetails::dispatch($request->users, $request->agent_data, 'post');

        return response("Data sent successfully.\nProcessing your CSV file, this process may take a while.\nAn email with your attachment will be sent.\nThank for you patience...");
    }

    /**
     * Sending the users details returned from queue.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function UsersDetailsResponse(Request $request)
    {
        $data = null;
        return gettype($this->userDetailsQueue);

        // Get data from queue when queue is finished.
        if ($this->userDetailsQueue != null) {
            $data = $this->userDetailsQueue->getResponse();
        }

        if ($data != null) {
            return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['message' => 'Error, no data set'], 401, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
