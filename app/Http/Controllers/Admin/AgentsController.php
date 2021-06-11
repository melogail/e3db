<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\AgentsRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
     * @param AgentsRequest $request
     * @return RedirectResponse
     */
    public function store(AgentsRequest $request)
    {

        /**
         * Logic
         */
        $validated = $request->validated();

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
     * @return Application|Factory|View
     */
    public function edit($agent_id)
    {
        /**
         * Logic
         */
        $agent = User::findOrFail($agent_id);


        /**
         * Data
         */
        $this->data['page'] = 'Edit Agent ' . $agent->fullName();
        $this->data['agent'] = $agent;

        /**
         * Return
         */
        return view('admin.agents.edit', $this->data);
    }

    /**
     * Save agent updated data
     * @param AgentsRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(AgentsRequest $request, $id)
    {
        $validated = $request->validated();

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'department' => $request->department,
            'role' => $request->role,
            'active' => $request->active ?? null
        ];

        $agent = User::findOrFail($id);

        $agent->update($data);

        return redirect()->back()->with('success', '<p class="alert alert-success">Agent data updated successfully.</p>');
    }

    /**
     * Permanently delete agent
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $agent = User::findOrFail($id);

        $agent->forceDelete();

        return redirect()->back()->with('success', '<p class="alert alert-success">User deleted successfully.</p>');
    }
}
