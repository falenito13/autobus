@foreach($list as $val)

    <li class="list-group-item {{ isset($val['children']) ? 'sub' : '' }}" data-id="{{ $val['cat_id'] }}">
        <div class="list-wrapper">
            <span class="title">{{ $val['title'][$Locale] }}</span>
            <div class="options clearfix right">
                @if(in_array('status', $list_params['options']))
                    <span class="text-status {{ $val['status_id'] == 1 ? 'green-status' : 'red-status' }}" data-toggle="tooltip" data-placement="top" title="Status" onclick="list.changeStatus(this, '{{ $list_params['post_table'] }}', {{ $val['cat_id'] }});">
            						<i class="ti-eye"></i>
                            </span>
                @endif
                @if(in_array('sort', $list_params['options']))
                    <span data-toggle="tooltip" data-placement="top" title="Up" class="shadow-inset" onclick="list.changeSortOrder(this, '{{ $list_params['post_table'] }}', '{{ $val['cat_id'] }}', 0);"><i class="ti-angle-up"></i></span>
                    <span data-toggle="tooltip" data-placement="top" title="Down" class="shadow-inset" onclick="list.changeSortOrder(this, '{{ $list_params['post_table'] }}', '{{ $val['cat_id'] }}', 1);"><i class="ti-angle-down"></i></span>
                @endif
                @if(isset($list_params['add_sub_item_title']) && $val['parent_id'] == 0)
                    <span  class="text-status green-status open-menu-modal" onclick="list.new('{{ $list_params['post_table'] }}','{{ $val['cat_id'] }}',{{isset($list_params['type_id']) ? $list_params['type_id'] : '"NULL"' }});">
                                        <i class="ti-plus" data-toggle="tooltip" data-placement="top" title="Add"></i>
                                    </span>
                @endif
                @if(in_array('edit', $list_params['options']))
                    <span class="text-dark-blue open-edit-modal" onclick="return list.view('{{ $val['cat_id'] }}','{{ $list_params['post_table'] }}')">
                                        <i class="ti-pencil-alt" data-toggle="tooltip" data-placement="top" title="Edit" ></i>
                                    </span>
                @endif
                @if(in_array('delete', $list_params['options']))
                    <span class="text-status red-status" data-toggle="tooltip" data-placement="top" title="Delete" onclick="list.delete(this, '{{ $list_params['post_table'] }}', {{ $val['cat_id'] }});">
                                    <i class="ti-trash"></i>
                                </span>
                @endif
            </div>
        </div>
        @if(isset($val['children']))
            <ul>
                @include('admin.list.sub_list',['list' => $val['children'], 'list_params' => $list_params])
            </ul>
        @else
            <ul></ul>
        @endif
    </li>
@endforeach
