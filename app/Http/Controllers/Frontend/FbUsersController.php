<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Django\FbUser;
use App\traits\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FbUsersController extends FrontendController
{
    use SearchLog;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Get search result for user main data
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        /**
         * Logic
         */

        // if no q, abort
        if (!request()->has('q') || !request()->filled('q')) {
            abort(404);
        }
        // Get request q
        $q = request()->q;

        // if url pattern contains "?id=*"
        preg_match('/\?id=(\d+)/', $q, $match);
        try {
            if (is_numeric($match[1])) {
                $q = $match[1];
            }
        } catch (\Exception $e) {
            // if pattern not match then split the url and get the last element
            $q = explode('/', rtrim($q, '/'));
            $q = end($q);
        }

        // Set default type
        $type = 'fb_id';

        if (request()->has('type') && request()->filled('type')) {
            $type = request()->type;
        }


        // search according to type
        $search_types = ['fb_id', 'mobile', 'user_name'];
        if (!in_array($type, $search_types)) {
            abort(404);
        }

        if ($type == 'mobile') {
            $q = $q . '.0';
        }

        $user = FbUser::select('fb_id', 'name', 'mobile')->where($type, $q)->first();

        // if there is result, add to log
        if ($user) {
            $this->addLog($q, 'user', Auth::id());
        }

        /**
         * Data
         */
        $this->data['page_title'] = 'Show user';
        $this->data['user'] = $user;

        /**
         * Return
         */
        return view('search.result', $this->data);
    }

    /**
     * @param $fb_id
     */
    public function userDetails($fb_id)
    {
        $fb_id = base64_decode($fb_id);
        /**
         * Logic
         */
        $user = FbUser::select('fb_id', 'name', 'email', 'mobile', 'religion', 'birthday', 'user_name', 'employer', 'position', 'hometown', 'location', 'degree', 'relationship_status')->where('fb_id', $fb_id)->first();

        /**
         * Data
         */
        $this->data['page_title'] = $user->name;
        $this->data['user'] = $user;

        /**
         * Return
         */
        return view('search.details', $this->data);
    }
}
