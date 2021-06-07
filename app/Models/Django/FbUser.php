<?php

namespace App\Models\Django;


class FbUser extends Master
{

    /**
     * Targeted table
     *
     * @var string
     */
    protected $table = 'fb_users';


    /**
     * Mass assignment attributes
     *
     * @var string[]
     */
    protected $fillable = [
        'fb_id',
        'email',
        'mobile',
        'religion',
        'birthday',
        'first_name',
        'last_name',
        'gender',
        'fb_acc_lang',
        'user_name',
        'name',
        'employer',
        'position',
        'hometown',
        'location',
        'degree',
        'relationship_status',
        'created_at',
        'updated_at',
    ];

    /**
     * Casting dates
     *
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at'];

}
