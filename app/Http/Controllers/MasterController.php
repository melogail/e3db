<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $this->middleware(['inactive_agent']);
    }

    /**
     * @return Application|Factory|View
     */
    public function inactive_agent_redirect()
    {
        $this->data['page_title'] = 'Your Account Is Suspended';

        return view('inactive_redirect', $this->data);
    }
}
