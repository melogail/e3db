@extends('admin.app')
@section('links')
    <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@stop
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Choose Date Range</h3>
                            <!-- Date and time -->
                            <form action="{{route('admin.agents.report', $agent->id)}}" method="GET">
                                <div class="form-group">
                                    <label>Date and time range:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="daterange" class="form-control float-right"
                                               id="daterange">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Get Report" class="btn btn-block btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-12 -->

                @if($result !== null || $result === 0)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h3>Number Of Users Searched</h3>
                                <!-- Date and time -->
                                <p>{{$result}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@stop
@section('scripts')
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            //Date range picker with time picker
            $('#daterange').daterangepicker({
                timePicker: true,
                timePickerIncrement: 15,
                locale: {
                    separator: ' to ',
                    format: 'YYYY-MM-DD HH:mm:ss',
                }
            });
        });
    </script>
@stop
