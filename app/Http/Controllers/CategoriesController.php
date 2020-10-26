<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Helpers\Helpers;

class CategoriesController extends BaseController
{
    public function index()
    {
        $locale = localization()->getCurrentLocale();
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $Cats = Categories::orderBy('parent_id')
            ->orderBy('sort_order','asc')->get();
        $Attrs = json_decode(json_encode($Cats), true);

        return view('admin.list.index',[
            'list' 			=> Helpers::TraverseCats($Attrs),
            'list_params' 	=> [
                'post_table'		=> 'categories',
                'list_title' 		=> 'categories',
                'add_item_title' 	=> 'დამატება',
                //'type_id' 	        => $PostID,
                'add_sub_item_title'=> 'დამატება',
                //'Icon'              => 'Icon',
                'edit_item_title' 	=> 'Edit Menu Item',
                'options'			=> ['edit', 'sort', 'status','delete']
            ], 'Langs' => $supportedLocalekeys,'Locale' => $locale]);

    }
}
