<?php

namespace App\Http\Controllers;

use App;
use App\Attrs;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\Tasks;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $locale = localization()->getCurrentLocale();
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
//        $Cats = categories::orderBy('parent_id')
//            ->orderBy('sort_order','asc')->get();
//        $Attrs = json_decode(json_encode($Cats), true);

        return view('admin.index',['Langs' => $supportedLocalekeys,'Locale' => $locale]);
    }

    public function SaveTasks(Request $request) {
        $Item = new Tasks;
        $Task = $Item::find(1);
        $Task->descr = $request->input('Descr');
        if ($Task->save()){
            return response()->json(['StatusCode' => 1, 'StatusMessage' => 'ოპერაცია წარმატებით შესრულდა!']);
        } else {
            return response()->json(['StatusCode' => 0, 'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }

    }


    public function add_list_item(Request $request) {
        $Locale = localization()->getCurrentLocale();
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $ParentId = $request->input('ParentId');
        $SortOrder = DB::table($request->input('PostTable'))
                                ->where('parent_id', $ParentId)
                                ->max('sort_order');
        $NewListItemSortOrder = $SortOrder + 1;
        $title = [];
        foreach ($supportedLocalekeys as $localekey){
            $title[$localekey] = $request->input('Title-'.$localekey);
        }


        $model = app("App\\".$request->input('PostTable'));
        $model->setTranslations('title', $title);
        $model->sort_order = $NewListItemSortOrder;
        if ($request->input('TypeID') != NULL && $request->input('TypeID') != "NULL"){
            $model->type_id = $request->input('TypeID');
        }
        if ($request->input('PostTable') != 'categories'){
            $fileArray = array('image' => $request->file('Icon'));
            $rules = array(
                'image' => 'required|mimetypes:image/svg',
            );

            $validator = Validator::make($fileArray, $rules);
            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
            } else{
                $model->image = Helpers::UploadCategoryIcons($request->file('Icon'));
            }
        }


        $model->parent_id = $ParentId;

        if ($model->save()) {
            return response()->json(['StatusCode' => 1,
                'StatusMessage' => 'Menu ითემი წარმატებით დაემატა',
                'parent_id' 	=> $request->input('ParentId'),
                'PostTable' 	=> $request->input('PostTable'),
                'ID' => $model->cat_id,
                'title' => $request->input('Title-'.$Locale)]); // აქ დავუმატებთ მერე ლანგს ენის მიხედვით
        } else {
            return response()->json(['StatusCode' => 0, 'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }
    }


    public function view_list_item($PostID,$PostTable){
        $Data['Data']	= DB::table($PostTable)->where('cat_id','=',$PostID)->first();
        $Data['Locales'] = localization()->getSupportedLocalesKeys();
        $Data['PostTable'] = $PostTable;
        return $Data;
    }

    public function showeditmodal($Id, $Table){
        $data = new Attrs;
        $data->setTable($Table);

        $Data	= $data->withoutGlobalScope(ActiveScope::class)->find($Id);
        $Data['Locales'] = localization()->getSupportedLocalesKeys();
        return $Data;
    }

    public function editmodalpost(Request $request){

        $title = [];
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        foreach ($supportedLocalekeys as $localekey){
            $title[$localekey] = $request->input('Title-'.$localekey);
        }
        $data = new Attrs;
        $data->setTable($request->input('PostTable'));
        $item = $data->withoutGlobalScope(ActiveScope::class)->find($request->input('ID'));
        $item->setTranslations('title', $title);
        if ($item->save()) {
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'Menu ითემი წარმატებით დარედაქტირდა']);
        } else {
            return response()->json(['StatusCode' => 0, 'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }
    }

    public function edit_list_item(Request $request) {

        $Lang = localization()->getCurrentLocale();
        $title= [];
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        foreach ($supportedLocalekeys as $localekey){
            $title[$localekey] = $request->input('Title-'.$localekey);
        }



        $Table = app("App\\".$request->input('PostTable'));
        $model = $Table::find($request->input('ID'));
        if ($request->hasFile('Icon')){
            $fileArray = array('image' => $request->file('Icon'));
            $rules = array(
                'image' => 'required|mimetypes:image/svg',
            );
            $validator = Validator::make($fileArray, $rules);
            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
            } else{
                $model->image = Helpers::UploadCategoryIcons($request->file('Icon'));
            }
        }

        $model->setTranslations('title', $title);
        if ($model->save()) {
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'Menu ითემი წარმატებით დარედაქტირდა',
                    'title' => $request->input('Title-' . $Lang),
                    'ID' => $request->input('ID')]);
        } else {
            return response()->json(['StatusCode' => 0, 'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }

    }

    public function DeleteListItem($PostID,$PostTable)
    {

        if (DB::table($PostTable)
            ->where('cat_id', $PostID)
            ->update(['status_id' => Config::get('constants.deleted_status_id')])){
            $ParentID = DB::table('categories')
                            ->select('parent_id')
                            ->where('cat_id', $PostID)
                            ->first();
            //$this->UpdateSubListItems($ParentID->parent_id);
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'Menu ითემი წარმატებით დარედაქტირდა']);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }

    private function UpdateSubListItems($ParentID)
    {
        if ($ParentID) {
            $sql = "(SELECT GROUP_CONCAT(cat_id) FROM 'categories' where parent_id = $ParentID AND status_id = 2)";
            $ItemData = DB::table('categories')
                            ->select('parent_id', DB::raw("$sql AS sub_items"))
                            ->where('cat_id',$ParentID)
                            ->first();
            $ItemData['sub_items'] = rtrim($ItemData['sub_items'], ',');
            DB::table('categories')
                ->where('cat_id', $ParentID)
                ->update(['cat_id' => $ParentID . ( ! empty($ItemData['sub_items']) ? ',' . $ItemData['sub_items'] : '')]);
            $this->UpdateSubListItems($ItemData['parent_id']);
        }
    }

    public function ChangeListItemStatus($PostID,$PostTable)
    {
        $ItemData = DB::table($PostTable)
                    ->select('status_id', 'parent_id')
                    ->where('cat_id',$PostID)
                    ->first();

        $NewStatusID = $ItemData->status_id ? 0 : 1;

        if (DB::table($PostTable)
            ->where('cat_id', $PostID)
            ->update(['status_id' => $NewStatusID])){
            return response()
            ->json(['StatusCode' => 1, 'ItemStatusID' => $NewStatusID]);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }

    public function ChangeStatus(Request $request)
    {
        $ItemData = DB::table($request->PostTable)
            ->select('status_id')
            ->where('id',$request->ID)
            ->first();

        $NewStatusID = $ItemData->status_id ? 0 : 1;

        if (DB::table($request->PostTable)
            ->where('id', $request->ID)
            ->update(['status_id' => $NewStatusID])){
            return response()
                ->json(['StatusCode' => 1, 'ItemStatusID' => $NewStatusID]);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }

    public function ChangeSliderStatus(Request $request)
    {
        $ItemData = DB::table($request->PostTable)
            ->select('is_slider')
            ->where('id',$request->ID)
            ->first();

        $NewStatusID = $ItemData->is_slider ? 0 : 1;

        if (DB::table($request->PostTable)
            ->where('id', $request->ID)
            ->update(['is_slider' => $NewStatusID])){
            return response()
                ->json(['StatusCode' => 1, 'ItemStatusID' => $NewStatusID]);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }

    public function ChangeMainStatus(Request $request)
    {
        $Count =  DB::table($request->PostTable)
            ->where('is_main',1)
            ->count();
        $ItemData = DB::table($request->PostTable)
            ->select('is_main')
            ->where('id',$request->ID)
            ->first();

        if ($ItemData->is_main == 1) {
            $NewStatusID = $ItemData->is_main ? 0 : 1;

            if (DB::table($request->PostTable)
                ->where('id', $request->ID)
                ->update(['is_main' => $NewStatusID])){
                return response()
                    ->json(['StatusCode' => 1, 'ItemStatusID' => $NewStatusID]);
            }
            return response()
                ->json(['StatusCode' => 0,
                    'StatusMessage' => 'დაფიქსირდა შეცდომა']);
        } elseif($ItemData->is_main == 0 && $Count < $request->MaxMain){
            $NewStatusID = $ItemData->is_main ? 0 : 1;

            if (DB::table($request->PostTable)
                ->where('id', $request->ID)
                ->update(['is_main' => $NewStatusID])){
                return response()
                    ->json(['StatusCode' => 1, 'ItemStatusID' => $NewStatusID]);
            }
            return response()
                ->json(['StatusCode' => 0,
                    'StatusMessage' => 'დაფიქსირდა შეცდომა']);

        } else {
            return response()
                ->json(['StatusCode' => 0,
                    'StatusMessage' => 'მთავარ კომპონენტად შეგიძლიათ დააყენოთ მხოლოდ - '.$request->MaxMain]);
        }

    }

    public function DeletePost(Request $request)
    {
        if (DB::table($request->PostTable)
            ->where('id', $request->ID)
            ->update(['status_id' => 2])){
            return response()
                ->json(['StatusCode' => 1, 'ItemStatusID' => 2]);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }


    public function ChangeListItemSortOrder(Request $request)
    {
        $PostID = $request->input('ID');
        $SortID = $request->input('SortID');

        //getting first item data.
        $Table = app("App\\".$request->input('PostTable'));
        $ItemData 	= $Table::select(['sort_order','parent_id'])->where('cat_id', $PostID)->first();

        if ($SortID == 0){
            $SecondItemData = $Table::withoutGlobalScope(ActiveScope::class)->select(['sort_order','cat_id'])
                ->where('sort_order','<', $ItemData->sort_order)
                ->where('status_id','!=', 2)
                ->where('parent_id', $ItemData->parent_id)
                ->orderBy('sort_order','desc')
                ->first();
        } elseif ($SortID == 1){
            $SecondItemData = $Table::withoutGlobalScope(ActiveScope::class)->select(['sort_order','cat_id'])
                ->where('sort_order','>', $ItemData->sort_order)
                ->where('status_id','!=', 2)
                ->where('parent_id', $ItemData->parent_id)
                ->orderBy('sort_order','asc')
                ->first();
        }
//        //getting second item data limit 1
//        $SecondItemData = $Table::select(['sort_order','cat_id'])
//            ->where('sort_order',$SortID ? '>' : '<', $ItemData->sort_order)
//            ->where('status_id','!=', 2)
//            ->where('parent_id', $ItemData->parent_id)
//            ->orderBy('sort_order','desc')
//            ->first();

        //updating first item
        $Table::updateOrCreate(
            ['cat_id' => $PostID],
            ['sort_order' => $SecondItemData->sort_order]
        );
        //updating second item
        $Table::updateOrCreate(
            ['cat_id' => $SecondItemData['cat_id']],
            ['sort_order' => $ItemData['sort_order']]
        );

        return response()
            ->json(['StatusCode' => 1,
                'StatusMessage' => 'წარმატება!']);
    }

    public function ChangeTableItemSortOrder(Request $request)
    {
        $PostID = $request->input('ID');
        $SortID = $request->input('SortID');

        //getting first item data.
        $Table = app("App\\".$request->input('PostTable'));
        $ItemData 	= $Table::withoutGlobalScope(ActiveScope::class)->select(['sort_order'])->where('id', $PostID)->first();
        //getting second item data limit 1
        if ($SortID == 0){
            $SecondItemData = $Table::withoutGlobalScope(ActiveScope::class)->select(['sort_order','id'])
                ->where('sort_order','<', $ItemData->sort_order)
                ->orderBy('sort_order','desc')
                ->first();
        } elseif ($SortID == 1){
            $SecondItemData = $Table::withoutGlobalScope(ActiveScope::class)->select(['sort_order','id'])
                ->where('sort_order','>', $ItemData->sort_order)
                ->orderBy('sort_order','asc')
                ->first();
        }

        //updating first item
        $Table::withoutGlobalScope(ActiveScope::class)->updateOrCreate(
            ['id' => $PostID],
            ['sort_order' => $SecondItemData->sort_order]
        );
        //updating second item
        $Table::withoutGlobalScope(ActiveScope::class)->updateOrCreate(
            ['id' => $SecondItemData->id],
            ['sort_order' => $ItemData->sort_order]
        );

        return response()
            ->json(['StatusCode' => 1,
                'StatusMessage' => 'წარმატება!']);
    }
}


