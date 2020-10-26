<?php

namespace App\Http\Controllers\Home;

use App\Blog;
use App\Car;
use App\Category;
use App\Http\Controllers\BaseController;
use App\Location;
use App\Meta;
use App\Services;
use App\Tour;


class HomeController extends BaseController
{

    public function index()
    {
        $meta = Meta::where('type_id', '=', '1')->first();
        $services = Services::with('MainImage')->orderBy('created_at', 'desc')->limit(4)->get();
        $Category = Category::with('MainImage')->OrderBy('sort_order', 'asc')->get();
        $Car = Car::with('MainImage')->OrderBy('updated_at', 'desc') ->get();
        $CarCat =Category::WhereHas('Car')->OrderBy('updated_at', 'desc')->get();
        $Tours = Tour::with(['from', 'to'])->get();
//        dd($Tours);
        $Location = Location::with('MainImage')->orderBy('created_at', 'desc')->get();
        $Blogs = Blog::with('MainImage')
                             ->orderBy('created_at', 'desc')->orderByRaw('updated_at DESC')
                                  ->limit(4)
                                      ->get();
        return view('front.home.index', ['Meta' => $meta,'Services'=>$services, 'Cat'=>$Category,'Car'=>$CarCat, 'Cars' => $Car, 'Blog'=>$Blogs, 'Location'=>$Location, 'Tours'=>$Tours]);
    }

    public function Main(){

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        return view('admin.main.index',['Langs' => $supportedLocalekeys]);
    }

    public function privacy()
    {
        $meta = Meta::where('type_id', '=', '1')->first();
        return view('front.home.privacy',['Meta' => $meta]);
    }

    public function terms()
    {
        $meta = Meta::where('type_id', '=', '1')->first();
        return view('front.home.terms',['Meta' => $meta]);
    }
}
