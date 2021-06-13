@extends('admin.app')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Is Active</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($agents as $agent)
                                        <tr>
                                            <td>{{$agent->id}}</td>
                                            <td>{{$agent->first_name}} {{$agent->last_name}}</td>
                                            <td>{{$agent->username}}</td>
                                            <td>{{$agent->email}}</td>
                                            <td>{{$agent->department}}</td>
                                            <td>{{$agent->role}}</td>
                                            <td>
                                                @if($agent->active == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.agents.edit', $agent->id)}}" class="btn btn-sm btn-primary btn-block">Edit</a>
                                                <a href="{{route('admin.agents.report', $agent->id)}}" class="btn btn-sm btn-warning btn-block">Get Report</a>
                                            @if($agent->role != 'superuser')
                                                    <a href="{{route('admin.agents.delete', $agent->id)}}" class="btn btn-sm btn-danger btn-block">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@stop
