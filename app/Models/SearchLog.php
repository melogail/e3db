<?php

namespace App\Models;

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
}
