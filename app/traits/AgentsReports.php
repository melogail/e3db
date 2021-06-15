<?php


namespace App\traits;


use App\Models\User;
use Illuminate\Http\Request;

trait AgentsReports
{

    /**
     * Get user report
     *
     * @param Request $request
     * @param $agent_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request, $agent_id)
    {
        $agent = User::findOrFail($agent_id);
        $result = null;

        // If added date range
        if ($request->daterange) {
            $daterange = explode('to', $request->daterange);
            $from = trim($daterange[0]);
            $to = trim($daterange[1]);

            $result = $agent->log()->dateRange($from, $to)->count();
        }

        /**
         * Logic
         */

        /**
         * Data
         */
        $this->data['page_title'] = 'Agent Report';
        $this->data['agent'] = $agent;
        $this->data['result'] = $result;

        return view('admin.agents.report', $this->data);
    }
}
