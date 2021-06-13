@if(session('errors'))
    @foreach(session('errors')->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
@endif

@if(session('success'))
    {!! session('success') !!}
@endif

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
    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
</div>
<div class="form-group">
    <label for="department">Department</label>
    {!! Form::text('department', null, ['class' => 'form-control', 'id' => 'department', 'required']) !!}
</div>
<div class="form-group">
    <label for="role">Agent Role</label>
    {!! Form::select('role', $roles, null, ['placeholder' => '- Select Role -', 'class' => 'form-control', 'id' => 'role']); !!}
</div>
<div class="form-group">
    <div class="form-check">
        {!! Form::checkbox('active', 1, isset($agent) && $agent->active == 1 ? true : false, ['id' => 'active']); !!}
        <label class="form-check-label" for="is_active">Active</label>
    </div>
</div>
<div class="form-group">
    {!! Form::submit($submit_value, ['class' => 'btn-block btn btn-primary']) !!}
</div>
