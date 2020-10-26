<div id="Edit" class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <form id="edit-data" action="{{route('editlistitem')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ Lang::get('Menu.edit')}}</h4> </div>
                <div class="modal-body">
                    @foreach ($Langs as $Lang)
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">{{ Lang::get('Menu.title')}} - {{$Lang}}</label>
                            <input type="text" name="Title-{{$Lang}}" class="form-control" id="Title-{{$Lang}}" required value="">
                        </div>
                    @endforeach
                    @if(isset($list_params['Icon']))
                        <img id="Image" src="" alt="icon" style="height: 100px; width: 100px">
                        <div class="form-group">
                            <label for="Icon" class="control-label">Icon</label>
                            <p>100x100</p>
                            <input id="Icon" type="file" name="Icon">
                        </div>
                    @endif
                </div>
                <input type="hidden" id="PostTable" name="PostTable" value="">
                <input id="ParentId" type="hidden" name="ParentId" value="">
                <input id="TypeID" type="hidden" name="TypeID" value="">
                <input id="ID" type="hidden" name="ID" value="">

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ Lang::get('Menu.close')}}</button>
                    <button type="submit" id="submit" class="btn btn-danger waves-effect waves-light">{{ Lang::get('Menu.save')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
