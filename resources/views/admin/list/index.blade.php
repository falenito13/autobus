@extends('admin_layouts.dashboard')

@section('header')
    <link href="/plugins/bower_components/nestable/nestable.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{Lang::get('global.categories')}}</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">{{Lang::get('global.categories')}}</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class=".col-md-6">
                                <ul class="list-group">
                                    <li class="list-group" data-id="0">
                                        <div class="list-item-wrap">
                                            <b>{{ $list_params['list_title'] }}</b>
                                            @if($list_params['add_item_title'])
                                                <div class="options clearfix right">
                                                        <span class="btn btn-circle btn-success text-white open-menu-modal" onclick="list.new('{{ $list_params['post_table'] }}','0',{{isset($list_params['type_id']) ? $list_params['type_id'] : '"NULL"' }})">
                                                            <i class="ti-plus" data-toggle="tooltip" data-placement="top" title="Add"></i>
                                                        </span>

                                                </div>
                                            @endif
                                        </div>
                                        <ul class="list-group">
                                            @include('admin.list.sub_list',['list' => $list, 'list_params' => $list_params])
                                        </ul>
                                    </li>
                                </ul>
                                @include('admin.list.add',['list_params' => $list_params])
                                @include('admin.list.edit',['list_params' => $list_params])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; All rights reserved <a href="https://cgroup.ge">Cgroup.ge</a> </footer>
        </div>
        @endsection

        @section('footer')
            <script src="/plugins/bower_components/summernote/dist/summernote.min.js"></script>
            <script>
                jQuery(document).ready(function() {
                    $('.summernote').summernote({
                        height: 500, // set editor height
                        minHeight: null, // set minimum height of editor
                        maxHeight: null, // set maximum height of editor
                        focus: false // set focus to editable area after initializing summernote
                    });
                    $("form#add-data").submit(function(e) {
                        e.preventDefault();
                        var formData = new FormData(this);
                        return list.add(formData,$(this).attr('action'));
                    });

                    $("form#edit-data").submit(function(e) {
                        e.preventDefault();
                        var formData = new FormData(this);
                        return list.edit(formData,$(this).attr('action'));
                    });
                });
            </script>

@endsection
