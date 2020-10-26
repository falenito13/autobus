@extends('admin_layouts.dashboard')
@section('header')
    <link href="/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
    <link href="/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <script>
        let Data = '';
    </script>
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{ Lang::get('global.slider')}}</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">{{ Lang::get('global.slider')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <form data-toggle="validator" action="{{ route('admin.slider.store') }}" data-success-url="{{ route('admin.slider') }}" method="POST" onsubmit="return admin.savePost(this)">
                                @CSRF
                                <div class=".col-md-6">
                                    <h3 class="box-title m-b-0">{{ Lang::get('global.add_item')}}</h3>
                                    <p></p>
                                    @foreach ($Langs as $Lang)
                                        <div class="form-group">
                                            <label for="Title-{{$Lang}}" class="control-label">Title-{{$Lang}}</label>
                                            <input type="text" class="form-control" id="Title-{{$Lang}}" name="Title-{{$Lang}}" placeholder="{{ Lang::get('global.title')}}" required>
                                        </div>
                                    @endforeach

                                    @foreach ($Langs as $Lang)
                                        <div class="form-group">
                                            <label for="description" class="control-label">{{ Lang::get('global.descr')}} - {{$Lang}}</label>
                                            <textarea class="summernote" id="description" name="Descr-{{$Lang}}"> {{ Lang::get('global.descr')}} - {{$Lang}}</textarea>
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <p>სურათის ზომა - 1200/800</p>
                                        <div class="dropzone" id="my-awesome-dropzone"></div>
                                        <div class="btnWrapper">
                                        <button type="submit" class="btn btn-primary">{{ Lang::get('global.submit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script src="/admin_assets/js/validator.js"></script>
    <script src="/plugins/bower_components/summernote/dist/summernote.min.js"></script>
    <script type="text/javascript" data-accepted_files=".jpg,.jpeg,.png" data-PostTable="slider" data-max_files="1" src="/admin_assets/js/file.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 350, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });
    </script>

@endsection


