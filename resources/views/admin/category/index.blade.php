@extends('admin_layouts.dashboard')
@section('header')
    <link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{ Lang::get('global.category')}}</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">{{ Lang::get('global.category')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">{{ Lang::get('global.category')}}</h3>
                        <div style="padding: 20px">
                            <a href="{{ route('admin.category.add') }}" ><button type="button" class="btn btn-info btn-rounded">{{ Lang::get('global.add')}}</button></a>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th style="width: 250px !important;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category as $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->title}}</td>
                                        <td>{{ ($item->created_at)->format('Y-m-d') }}</td>
                                        <td style="float: right;">
                                        <span class="circle text-status {!! $item->status_id == 1 ? 'green-status' : 'red-status' !!}" data-toggle="tooltip" data-placement="top" title="Status" onclick="admin.changePostStatus(this, 'category',{{ $item->id }});">
            						<i class="ti-eye"></i>
                                    </span>
                                            <a href="#"><span class="circle circle-sm bg-danger di" onclick="return admin.deletePost(this,'category','{{$item->id}}');"><i class="ti-trash"></i></span><span></span></a>
                                            <a href="{{ route('admin.category.edit',[$item->id]) }}"><span class="circle circle-sm bg-success di"><i class="ti-pencil-alt"></i></span><span></span></a>
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
            $('#myTable').DataTable({
                "order": [[2, 'desc']]
            });
        });
    </script>
@endsection


