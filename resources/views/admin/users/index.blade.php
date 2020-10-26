@extends('admin_layouts.dashboard')
@section('header')
    <link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{ Lang::get('global.users')}}</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">{{ Lang::get('global.users')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">{{ Lang::get('global.users')}}</h3>
                        <div style="padding: 20px">
                        <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New User</button>
                        </div>
                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Add New User</h4> </div>
                                    <form class="form-horizontal form-material" data-success-url="{{ route('admin.users') }}" method="POST" action="{{ route('addUser') }}" onsubmit="return admin.savePost(this)">
                                        @CSRF
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" placeholder="Name" name="Name" required> </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" placeholder="Email" name="Email" required> </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="password" class="form-control" placeholder="Password" name="Password" required> </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="password" class="form-control" placeholder="Repeat Password" name="Password_confirmation" required> </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect">Save</button>
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th style="width: 250px !important;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td style="float: right;">
                                        <span class="circle text-status {!! $user->status_id == 1 ? 'green-status' : 'red-status' !!}" data-toggle="tooltip" data-placement="top" title="Status" onclick="admin.changePostStatus(this, 'users', {{ $user->id }});">
            						<i class="ti-eye"></i>
                                    </span>
                                        <a href="#"><span class="circle circle-sm bg-danger di"><i class="ti-trash"></i></span><span></span></a>
                                        <a href="#"><span class="circle circle-sm bg-success di"><i class="ti-pencil-alt"></i></span><span></span></a>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->

        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2019 &copy; All rights reserved <a href="https://cgroup.ge">Cgroup.ge</a> </footer>
    </div>
@endsection
@section('footer')
    <script src="/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection


