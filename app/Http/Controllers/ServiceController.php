<?php

namespace App\Http\Controllers;

use App\Files;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    public function service()
    {
        $service = Service::withoutGlobalScope(ActiveScope::class)->orderBy('created_at', 'asc')->get();
        return view('admin.service.index', ['service' => $service  ]);
    }
    public function createService()
    {
        return view('admin.service.add');
    }
    public function AddServicePost(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'service';
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' . $locale => 'required|string|max:255',
                'Descr-' . $locale => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' სათაური არ უნდა იყოს ცარიელი']);
            }
        }

        foreach ($supportedLocalekeys as $localekey) {
            $title[$localekey] = $request->input('Title-' . $localekey);
            $descr[$localekey] = $request->input('Descr-' . $localekey);
        }

        $service = new Service;
        $service->setTranslations('title', $title);
        $service->setTranslations('descr', $descr);

        if ($service->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $service->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$service->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$service->id);
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

    public function serviceById($serviceId)
    {
        $item = Service::withoutGlobalScope(ActiveScope::class)->find($serviceId);
        $Files = Files::where('route_id', $serviceId)
            ->where('route_name', 'service')
            ->get()->toJson();

        return view('admin.service.edit', ['item' => $item,'Files' => $Files]);
    }
    public function serviceUpdate(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr= [];
        $Route = 'service';
        $ID = $request->input('ID');
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' . $locale => 'required|string|max:255',
                'Descr-' . $locale => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' არ უნდა იყოს ცარიელი']);
            }
        }
        foreach ($supportedLocalekeys as $localekey) {
            $title[$localekey] = $request->input('Title-'.$localekey);
            $descr[$localekey] = $request->input('Descr-'.$localekey);
        }


        $Item = new Service;
        $service = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $service->setTranslations('title', $title);
        $service->setTranslations('descr', $descr);


        if ($service->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $service->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$service->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$service->id);
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
