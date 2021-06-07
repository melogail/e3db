<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Main data container
     *
     * @var
     */
    protected $data;

    public function __construct()
    {
        $this->data['page_title'] = '';
    }
}
