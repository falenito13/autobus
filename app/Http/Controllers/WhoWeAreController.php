<?php

namespace App\Http\Controllers;

use App\Files;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\WhoWeAre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhoWeAreController extends Controller
{
    public function whoWeAre()
    {
        $whoWeAre = WhoWeAre::withoutGlobalScope(ActiveScope::class)->orderBy('created_at', 'asc')->get();
        return view('admin.whoweare.index', ['whoWeAre' => $whoWeAre  ]);
    }
    public function createWhoWeAre()
    {
        return view('admin.whoweare.add');
    }
    public function addWhoWeArePost(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $descr = [];
        $Route = 'who_we_are';
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Descr-' . $locale => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' სათაური არ უნდა იყოს ცარიელი']);
            }
        }

        foreach ($supportedLocalekeys as $localekey) {
            $descr[$localekey] = $request->input('Descr-' . $localekey);
        }

        $whoWeAre = new WhoWeAre;
        $whoWeAre->setTranslations('descr', $descr);

        if ($whoWeAre->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $whoWeAre->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$whoWeAre->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$whoWeAre->id);
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

    public function whoWeAreById($serviceId)
    {
        $item = WhoWeAre::withoutGlobalScope(ActiveScope::class)->find($serviceId);
        $Files = Files::where('route_id', $serviceId)
            ->where('route_name', 'who_we_are')
            ->get()->toJson();

        return view('admin.whoweare.edit', ['item' => $item,'Files' => $Files]);
    }
    public function whoWeAreUpdate(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr= [];
        $Route = 'who_we_are';
        $ID = $request->input('ID');
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Descr-' . $locale => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' არ უნდა იყოს ცარიელი']);
            }
        }
        foreach ($supportedLocalekeys as $localekey) {
            $descr[$localekey] = $request->input('Descr-'.$localekey);
        }


        $Item = new WhoWeAre;
        $whoWeAre = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $whoWeAre->setTranslations('descr', $descr);


        if ($whoWeAre->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $whoWeAre->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$whoWeAre->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$whoWeAre->id);
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
