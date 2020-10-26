<?php

namespace App\Helpers;
use App\Files;
use Illuminate\Support\Facades\File;

class Helpers
{
    public static function UploadImages($File,$ID,$Route){

        //check if image is file instance
        if(!is_array($File)) {
            $extension = pathinfo(public_path('/tmp/'.$File), PATHINFO_EXTENSION);
            if (in_array($extension, unserialize(config('constants.IMG')))) {
                $largedir = public_path() . config('constants.UPLOADS.' . $Route . '.LARGE_DIR');
                $thumbsdir = public_path(config('constants.UPLOADS.' . $Route . '.THUMBS_DIR'));
                //check if the directory exists
                if (!File::isDirectory($largedir)) {
                    //make the directory because it doesn't exists
                    File::makeDirectory($largedir, 0755, true);
                }
                if (!File::isDirectory($thumbsdir)) {
                    File::makeDirectory($thumbsdir, 0755, true);
                }
                $L = File::move(
                    public_path() . '/tmp/large_' . $File,
                    public_path() . config('constants.UPLOADS.' . $Route . '.LARGE_DIR') . $File);
                $T = File::move(
                    public_path() . '/tmp/thumb_' . $File,
                    public_path() . config('constants.UPLOADS.' . $Route . '.THUMBS_DIR') . $File);
                //if not file, than just save to db
                if ($L && $T) {
                    $file = new Files;
                    //assigning
                    $file->route_id = $ID;
                    $file->file_size = File::size(public_path().config('constants.UPLOADS.'.$Route.'.LARGE_DIR').$File);
                    $file->name = $File;
                    $file->route_name = $Route;
                    //saving records
                    if ($file->save()){
                        return response()->json(['StatusCode' => 1,
                            'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);
                    }

                } else {
                    return response()->json(['StatusCode' => 1,
                        'StatusMessage' => 'ვერ მოხერხდა ტმპ ფოლდერიდან ფაილების გადატანა']);
                }
            } elseif ($extension == 'svg') {
                $svgdir = public_path(config('constants.UPLOADS.' . $Route . '.SVG_DIR'));
                if (!File::isDirectory($svgdir)) {
                    //make the directory because it doesn't exists
                    File::makeDirectory($svgdir, 0755, true);
                }
                $SVG = File::move(
                    public_path() . '/tmp/' . $File,
                    public_path() . config('constants.UPLOADS.' . $Route . '.SVG_DIR') . $File);
                if ($SVG){
                    $file = new Files;
                    //assigning
                    $file->route_id = $ID;
                    $file->file_size = File::size(public_path().config('constants.UPLOADS.'.$Route.'.SVG_DIR').$File);
                    $file->name = $File;
                    $file->route_name = $Route;
                    //saving records
                    if ($file->save()){
                        return response()->json(['StatusCode' => 1,
                            'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);
                    }
                }else {
                    return response()->json(['StatusCode' => 1,
                        'StatusMessage' => 'ვერ მოხერხდა ტმპ ფოლდერიდან ფაილების გადატანა']);
                }

            }


        } elseif (is_array($File)){
            $file = new Files;
            //assigning
            $file->route_id = $ID;
            $file->file_size = $File['size'];
            $file->name = $File['name'];
            $file->route_name = $Route;
            //saving records
            if ($file->save()){
                return response()->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);

                }
        }

    }

    public static function UploadCategoryIcons($Icon)
    {

        $imageName = time().'.'.$Icon->getClientOriginalExtension();
        $Icon->move(public_path('images'), $imageName);
        return $imageName;
    }

    public static function RemoveFiles($Route,$ID)
    {
            $FileCount = Files::where('route_id', $ID)
                        ->where('route_name', $Route)->count();
            if ($FileCount == 0){
                return true;
            } else {
               return Files::where('route_id', $ID)
                    ->where('route_name', $Route)
                    ->delete();
            }

    }

    public static function SaveCats($Cat_id,$Type_id,$Attr_id)
    {
        $FileCount = CatCon::where('attr_id', $Attr_id)
            ->where('type_id', $Type_id)->count();
        if ($FileCount == 0) {
            foreach ($Cat_id as $key => $value) {
                $cat = new CatCon;
                $cat->cat_id = $value;
                $cat->attr_id = $Attr_id;
                $cat->type_id = $Type_id;
                $cat->save();
            }
        } else {
            CatCon::where('attr_id', $Attr_id)
                ->where('type_id', $Type_id)
                ->delete();
            foreach ($Cat_id as $key => $value) {
                $cat = new CatCon;
                $cat->cat_id = $value;
                $cat->attr_id = $Attr_id;
                $cat->type_id = $Type_id;
                $cat->save();
            }


        }
    }

    public static function TraverseCats($List = array())
    {
        $Cats = array();
        foreach($List AS $CatID => $CatData) {
            if(intval($CatData['parent_id']) == 0) {
                $Cats[$CatData['cat_id']] = $CatData;
                continue;
            }
            if(isset($Cats[$CatData['parent_id']])) {
                if(!isset($Cats[$CatData['parent_id']]['children']))
                    $Cats[$CatData['parent_id']]['children'] = [];
                $Cats[$CatData['parent_id']]['children'][$CatData['cat_id']] = $CatData;
            }
        }
        return $Cats;
    }
}
