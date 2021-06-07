<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Main landing page
     */
    public function index()
    {
        /**
         * Data
         */
        $this->data['page_title'] = 'User Search';

        return view('index', $this->data);
    }
}
