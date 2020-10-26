<?php

namespace App\Http\Controllers;

use App\Files;
use App\Helpers\Helpers;
use App\Scopes\StatusScopes\ActiveScope;
use App\Blog;
use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function blog()
    {
        $service = Blog::withoutGlobalScope(ActiveScope::class)->orderBy('created_at', 'asc')->get();
        return view('admin.blog.index', ['blog' => $service  ]);
    }
    public function createBlog()
    {
        $categories = Categories::withoutGlobalScope(ActiveScope::class)->where('parent_id','=','14')->get();
        return view('admin.blog.add',['categories' => $categories]);
    }
    public function AddBlogPost(Request $request)
    {
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr = [];
        $Route = 'blog';
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

        $blog = new Blog;
        $blog->setTranslations('title', $title);
        $blog->setTranslations('descr', $descr);
        $blog->parent_id = $request->input('select');

        if ($blog->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $blog->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$blog->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$blog->id);
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

    public function blogById($blogId)
    {
        $categories = Categories::withoutGlobalScope(ActiveScope::class)->where('parent_id','=','14')->get();
        $item = Blog::withoutGlobalScope(ActiveScope::class)->find($blogId);
        $Files = Files::where('route_id', $blogId)
            ->where('route_name', 'blog')
            ->get()->toJson();

        return view('admin.blog.edit', ['item' => $item,'Files' => $Files,'categories' => $categories]);
    }
    public function blogUpdate(Request $request)
    {

        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $title = [];
        $descr= [];
        $Route = 'blog';
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


        $Item = new Blog;
        $blog = $Item::withoutGlobalScope(ActiveScope::class)->find($ID);
        $blog->setTranslations('title', $title);
        $blog->setTranslations('descr', $descr);
        $blog->parent_id = $request->input('select');

        if ($blog->save()) {
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $blog->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$blog->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$blog->id);
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
