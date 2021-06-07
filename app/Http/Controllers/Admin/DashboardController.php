<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        /**
         * Logic
         */

        /**
         * Data
         */
        $this->data['page_title'] = 'E3DB Dashboard';
        /**
         * Return
         */
        return view('admin.dashboard', $this->data);
    }
}
