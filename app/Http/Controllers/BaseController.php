<?php

namespace App\Http\Controllers;

use App\Events;
use App\Helpers\Collection;
use App\Library;
use App\Meta;
use App\News;
use App\Posts;
use App\Publications;
use App\Videos;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{

    public function isAdminRequest()
    {
        $locale = localization()->getCurrentLocale();

        return (Route::getCurrentRoute()->getPrefix() == ''. $locale . '/admin');
    }

    public function Search($Word) {
        $Locale = localization()->getCurrentLocale();
        $News = News::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('publish_date','desc')->get();
        $Events = Events::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('publish_date','desc')->get();
        $Publications = Publications::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('publish_date','desc')->get();
        $Library = Library::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('created_at','desc')->get();
        $Videos = Videos::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('created_at','desc')->get();
        $Posts = Posts::where('title->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orWhere('descr->'.$Locale.'', 'like', '%'.$Word.'%')
            ->orderBy('created_at','desc')->get();
        $Base = collect();
        $Data = $Base->merge($Videos)
            ->merge($Events)
            ->merge($News)
            ->merge($Library)
            ->merge($Posts)
            ->merge($Publications)->sortByDesc('created_at');

        $collection = (new Collection($Data))->paginate(6);
        $Route = Route::getCurrentRoute()->getName();
        $meta = Meta::where('type_id','=','1')->first();
        //dd($collection);
        return view('front.home.search',['Word' => $Word,'Items' => $collection, 'Route' => $Route, 'Meta' => $meta]);
    }
}
