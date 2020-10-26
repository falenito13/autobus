<?php

namespace App\Http\Controllers;

use App\Files;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\AdditionalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdditionalServiceController extends Controller
{

    public function additionalService()
    {
        $additionalService = AdditionalService::withoutGlobalScope(ActiveScope::class)->orderBy('created_at', 'asc')->get();
        return view('admin.additionalservice.index', ['additionalService' => $additionalService  ]);
    }
    public function createAdditionalService()
    {
        return view('admin.additionalservice.add');
    }
    public function AddAdditionalServicePost(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'additional_service';
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

        $additionalService = new AdditionalService;
        $additionalService->setTranslations('title', $title);
        $additionalService->setTranslations('descr', $descr);

        if ($additionalService->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $additionalService->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$additionalService->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$additionalService->id);
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

    public function additionalServiceById($serviceId)
    {
        $item = AdditionalService::withoutGlobalScope(ActiveScope::class)->find($serviceId);
        $Files = Files::where('route_id', $serviceId)
            ->where('route_name', 'additional_service')
            ->get()->toJson();

        return view('admin.additionalservice.edit', ['item' => $item,'Files' => $Files]);
    }
    public function additionalServiceUpdate(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr= [];
        $Route = 'additional_service';
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


        $Item = new AdditionalService;
        $additionalService = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $additionalService->setTranslations('title', $title);
        $additionalService->setTranslations('descr', $descr);


        if ($additionalService->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $additionalService->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$additionalService->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$additionalService->id);
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
