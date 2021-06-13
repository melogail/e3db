<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    /**
     * Targeted table
     *
     * @var string
     */
    protected $table = 'search_log';

    /**
     * Mass assignment attributes
     *
     * @var string[]
     */
    protected $fillable = ['search_query', 'type', 'user_id'];

    /**
     * Casting dates
     *
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Return data between date range
     *
     * @param $query
     * @param $from
     * @param $to
     */
    public function scopeDateRange($query, $from, $to)
    {
        $query->whereBetween('created_at', [Carbon::parse($from)->format('Y-m-d h:m:s'), Carbon::parse($to)->format('Y-m-d h:m:s')]);
    }
}
