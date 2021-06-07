<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Http\Request;

class AgentsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Listing all registered agents
     */
    public function index()
    {
        /**
         * Logic
         */
        $agents = User::all();

        /**
         * Data
         */
        $this->data['page_title'] = 'List All Agents';
        $this->data['agents'] = $agents;

        /**
         * Return
         */
        return view('admin.agents.index', $this->data);
    }

    /**
     * Add new agent view
     */
    public function create()
    {

        /**
         * Data
         */
        $this->data['page_title'] = 'Add New Agent';

        /**
         * Return
         */
        return view('admin.agents.create', $this->data);
    }

    /**
     * Store agent to database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        /**
         * Logic
         */
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'username' => 'required|unique:users',
            'department' => 'required',
            'role' => 'required',
        ]);

        // crypt password
        $request->merge(['password' => bcrypt($request->password)]);

        User::create($request->all());

        /**
         * Return
         */
        return redirect()->back()->with('success', '<p class="alert alert-success">New agent added successfully</p>');
    }

    /**
     * Edit agent data
     * @param $agent_id
     */
    public function edit($agent_id)
    {

    }

    /**
     * Save agent updated data
     * @param Request $request
     */
    public function update(Request $request)
    {

    }

    /**
     * Permanently delete agent
     * @param $agent_id
     */
    public function delete($agent_id)
    {

    }
}
