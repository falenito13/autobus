<?php

namespace App\Http\Controllers;

use App\aServices;
use App\Files;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{

    public function slider()
    {
        $slider = Slider::withoutGlobalScope(ActiveScope::class)->orderBy('created_at', 'asc')->get();
        return view('admin.slider.index', ['slider' => $slider  ]);
    }
    public function createSlider()
    {
        return view('admin.slider.add');
    }
    public function storeSlider(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'slider';
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

        $Slider = new Slider;
        $Slider->setTranslations('title', $title);
        $Slider->setTranslations('descr', $descr);

        if ($Slider->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Slider->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$Slider->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$Slider->id);
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

    public function sliderById($sliderId)
    {
        $item = Slider::withoutGlobalScope(ActiveScope::class)->find($sliderId);
        $Files = Files::where('route_id', $sliderId)
            ->where('route_name', 'slider')
            ->get()->toJson();

        return view('admin.slider.edit', ['item' => $item,'Files' => $Files]);
    }
    public function sliderUpdate(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr= [];
        $Route = 'slider';
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


        $Item = new Slider;
        $slider = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $slider->setTranslations('title', $title);
        $slider->setTranslations('descr', $descr);


        if ($slider->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $slider->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$slider->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$slider->id);
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
