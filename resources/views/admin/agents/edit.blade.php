@extends('admin.app')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($agent, ['method' => 'patch', 'route' => ['admin.agents.update', $agent->id]]) !!}
                            @include('admin.agents.partials._form', ['submit_value' => 'Update Agent'])
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
