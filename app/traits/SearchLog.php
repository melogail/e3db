<?php


namespace App\traits;


use App\Models\SearchLog as SearchLogModel;

trait SearchLog
{
    /**
     * Add Log
     *
     * @param $search_query
     * @param $type
     * @param $user_id
     */
    public function addLog($search_query, $type, $user_id)
    {
        SearchLogModel::create([
            'search_query' => $search_query,
            'type' => $type,
            'user_id' => $user_id,
        ]);
    }
}
