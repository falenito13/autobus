<?php

namespace App\Http\Controllers;

use App\Files;
use App\Helpers\Helpers;
use App\Location;
use App\Meta;
use App\Scopes\StatusScopes\ActiveScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index(){
        $meta = Meta::where('type_id', '=', '7')->first();
//        dd($meta);
        $Location = Location::with('MainImage')->orderBy('created_at', 'desc')->get();
//        dd($Location);
        return view('front.Location.index', ['Location' => $Location, 'Meta' => $meta]);
    }
    public function LocationsAjax(){
        $Location = Location::orderBy('created_at', 'desc')->get();
        return  response()->json(['Location'=>$Location]);
    }
    public function Location()
    {
        $Location = Location::withoutGlobalScope(ActiveScope::class)
            ->orderBy('created_at', 'asc')->get();
        return view('admin.Location.index', ['Location' => $Location]);
    }

    public function addLocation()
    {

        return view('admin.Location.add');
    }

    public function AddLocationPost(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $Route = 'locations';
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' . $locale => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' სათაური არ უნდა იყოს ცარიელი']);
            }
        }

        foreach ($supportedLocalekeys as $localekey) {
            $title[$localekey] = $request->input('Title-' . $localekey);
        }

        $Location = new Location;
        $Location->setTranslations('title', $title);
        $Location->lat = $request->input('lat');
        $Location->lng = $request->input('lng');

        if ($Location->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Location->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$Location->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$Location->id);
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

    public function LocationById($PostID){

        $item = Location::withoutGlobalScope(ActiveScope::class)->find($PostID);
        $Files = Files::where('route_id', $PostID)
            ->where('route_name', 'locations')
            ->get()->toJson();
        return view('admin.Location.edit', ['item' => $item,'Files' => $Files]);
    }

    public function EditLocationPost(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $Route = 'locations';
        $ID = $request->input('ID');
        foreach ($supportedLocalekeys as $locale) {
            $validator = Validator::make($request->all(), [
                'Title-' . $locale => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'Title-' . $locale . ' არ უნდა იყოს ცარიელი']);
            }
        }
        foreach ($supportedLocalekeys as $localekey) {
            $title[$localekey] = $request->input('Title-' . $localekey);
        }


        $Item = new Location;
        $Location = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $Location->setTranslations('title', $title);
        $Location->lat = $request->input('lat');
        $Location->lng = $request->input('lng');

        if ($Location->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Location->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$Location->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$Location->id);
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
