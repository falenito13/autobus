@extends('admin_layouts.dashboard')
@section('header')
    <link href="/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
    <script>
        let Json = '{!! $Files !!}';
        let Data = JSON.parse(Json);
    </script>
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{ Lang::get('global.contact')}}</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">{{ Lang::get('global.contact')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <form data-toggle="validator" action="{{ route('admin.contact.editpost') }}" data-success-url="{{ route('admin.contact.edit',1) }}" method="POST" onsubmit="return admin.savePost(this)">
                                @CSRF
                                <div class=".col-md-6">
                                    <h3 class="box-title m-b-0">{{ Lang::get('global.add_item')}}</h3>
                                    <p></p>

                                        <div class="form-group">
                                            <label for="Phone" class="control-label">{{Lang::get('global.phone')}}</label>
                                            <input type="text" class="form-control" id="Phone" name="Phone" value="{{$item->phone}}" placeholder="{{ Lang::get('global.phone')}}" required>
                                        </div>
                                    <div class="form-group">
                                        <label for="Title" class="control-label">{{Lang::get('global.email')}}</label>
                                        <input type="text" class="form-control" id="Email" name="Email" value="{{$item->email}}" placeholder="{{ Lang::get('global.email')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Title" class="control-label">Facebook</label>
                                        <input type="text" class="form-control" id="FB" name="fb_link" value="{{$item->fb_link}}" placeholder="Facebook" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Title" class="control-label">Instagram</label>
                                        <input type="text" class="form-control" id="Instagram" name="ins_link" value="{{$item->ins_link}}" placeholder="{{ Lang::get('global.link')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Title" class="control-label">Linkedin</label>
                                        <input type="text" class="form-control" id="Linkedin" name="ln_link" value="{{$item->tw_link}}" placeholder="{{ Lang::get('global.link')}}" required>
                                    </div>
                                    @foreach ($Langs as $Lang)
                                        <div class="form-group">
                                            <label for="Address-{{$Lang}}" class="control-label">Address -{{$Lang}}</label>
                                            <input type="text" class="form-control" id="Address-{{$Lang}}" name="Address-{{$Lang}}" value="{{$item->trans('address', $Lang)}}" placeholder="{{ Lang::get('global.address')}}" required>
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <p>სურათის ზომა - 1200/800</p>
                                        <div class="dropzone" id="my-awesome-dropzone"></div>
                                        <div class="btnWrapper">
                                        <input type="hidden" name="ID" value="1">
                                        <button type="submit" class="btn btn-primary">{{ Lang::get('global.edit')}}</button>
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
    <script type="text/javascript" data-accepted_files=".jpeg,.jpg,.png,.gif" data-PostTable="contact" data-max_files="1" src="/admin_assets/js/file.js"></script>
    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 350, // set editor height
                width: 500,
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });
    </script>
@endsection


