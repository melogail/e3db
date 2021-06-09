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

    /**
     *  Facebook Collector Software View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function downloadFacebookCollector()
    {
        $this->data['page_title'] = 'Download Facebook Collector Software';

        return view('download_facebook_collector', $this->data);
    }

    /**
     * Download Facebook Collector
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFb()
    {
        return response()->download(storage_path('app/downloads/Facebook Collector.zip'));
    }
}
