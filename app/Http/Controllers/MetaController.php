<?php

namespace App\Http\Controllers;


use App\Files;
use App\Helpers\Helpers;
use App\Meta;
use App\Scopes\StatusScopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaController extends BaseController
{
    public function Meta()
    {

        $Meta = Meta::withoutGlobalScope(ActiveScope::class)
            ->orderBy('created_at','asc')->get();
        return view('admin.meta.index',['Meta' => $Meta]);
    }

    public function addMeta()
    {
        $max_files = 1;
        return view('admin.meta.add',
            ['max_files' => $max_files]);
    }

    public function AddMetaPost(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'meta';
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' .$locale => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale .' სათაური არ უნდა იყოს ცარიელი']);
            }
        }

        foreach ($supportedLocalekeys as $localekey){
            $title[$localekey] = $request->input('Title-'.$localekey);
            $descr[$localekey] = $request->input('Descr-'.$localekey);
        }
        $Meta = new Meta;
        $Meta->setTranslations('title', $title);
        $Meta->setTranslations('descr', $descr);

        if ($Meta->save()){
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Meta->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$Meta->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$Meta->id);
            }
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);
        } else {
            return response()
                ->json(['StatusCode' => 0,
                    'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }

    }

    public function MetaById($PostID){
        $max_files = 1;
        $item = Meta::withoutGlobalScope(ActiveScope::class)->find($PostID);
        $Files = Files::where('route_id', $PostID)
            ->where('route_name', 'meta')
            ->get()->toJson();
        return view('admin.meta.edit',
            ['max_files' => $max_files, 'item' => $item,'Files' => $Files]);
    }

    public function EditMetaPost(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'meta';
        $ID = $request->input('ID');
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' .$locale => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale .' სათაური არ უნდა იყოს ცარიელი']);
            }
        }

        foreach ($supportedLocalekeys as $localekey){
            $title[$localekey] = $request->input('Title-'.$localekey);
            $descr[$localekey] = $request->input('Descr-'.$localekey);
        }
        $Item = new Meta;
        $Meta = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $Meta->setTranslations('title', $title);
        $Meta->setTranslations('descr', $descr);

        if ($Meta->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Meta->id)) {
                    foreach ($request->File as $image) {
                        Helpers::UploadImages($image, $Meta->id, $Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }
            } elseif ($request->file('File') == null || !$request->file('File')) {
                Helpers::RemoveFiles($Route, $Meta->id);
            }
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);
        } else {
            return response()
                ->json(['StatusCode' => 0,
                    'StatusMessage' => 'დაფიქსირდა შეცდომა!']);
        }
    }
}
