@extends('admin.app')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('errors'))
                                @foreach(session('errors') as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif

                            @if(session('success'))
                                {!! session('success') !!}
                            @endif

                            {!! Form::open(['method' => 'post', 'route' => ['admin.agents.store']]) !!}

                            <div class="form-group">
                                <label for="first_name">First name</label>
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                {!! Form::text('department', null, ['class' => 'form-control', 'id' => 'department', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="role">Agent Role</label>
                                {!! Form::select('role', ['moderator' => 'Moderator', 'editor' => 'Editor', 'supervisor' => 'Supervisor', 'admin' => 'Admin'], null, ['placeholder' => '- Select Role -', 'class' => 'form-control', 'id' => 'role']); !!}
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    {!! Form::checkbox('is_active', 1, isset($user) && $user->active == 1 ? true : false, ['id' => 'is_active']); !!}
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Add New Agent', ['class' => 'btn-block btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
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
