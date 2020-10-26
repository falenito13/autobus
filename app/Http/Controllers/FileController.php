<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileController extends BaseController
{
    public function UploadFiles(Request $request) {

        if ($request->hasFile('File')) {
            if (!File::isDirectory(public_path('/tmp/'))) {
                //make the directory because it doesn't exists
                File::makeDirectory(public_path('/tmp/'), 0777, true);
            }
            foreach ($request->file('File') as $File) {
                if (in_array(Str::lower($File->getClientOriginalExtension()), unserialize(config('constants.IMG')))) {

                    //get filename with extension
                    $filenamewithextension = $File->getClientOriginalName();

                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //get file extension
                    $extension = Str::lower($File->getClientOriginalExtension());

                    //filename to store
                    $filenametostore = $filename . '_' . time() . '.' . $extension;
                    //upload path here 'uploads/news/thumbs/'
                    $largepath = public_path('/tmp/large_' . $filenametostore);
                    $thumbnailpath = public_path('/tmp/thumb_' . $filenametostore);

                    //Resize image here
                    $large = Image::make($File)
                        ->resize(config('constants.UPLOADS.' . $request->PostTable . '.LARGE_WIDTH'),
                            config('constants.UPLOADS.' . $request->PostTable . '.LARGE_HEIGHT'),
                            function ($constraint) {
                                $constraint->aspectRatio();
                            });
                    $thumb = Image::make($File)
                        ->resize(config('constants.UPLOADS.' . $request->PostTable . '.THUMBS_WIDTH'),
                            config('constants.UPLOADS.' . $request->PostTable . '.THUMBS_HEIGHT'),
                            function ($constraint) {
                                $constraint->aspectRatio();
                            });

                    //save images here
                    if ($large->save($largepath) && $thumb->save($thumbnailpath)) {
                        return response()
                            ->json([
                                'file_size' => $File->getSize(),
                                'file_name' => $filenametostore,
                                'original_name' => Str::lower($File->getClientOriginalExtension()),
                                'mime_type' => $File->getClientMimeType()
                            ]);
                    } else {
                        return response()
                            ->json(['StatusCode' => 0,
                                'StatusMessage' => 'ვერ მოხერხდა სურათების შენახვა']);
                    }


                }elseif (Str::lower($File->getClientOriginalExtension()) == 'svg'){
                    //get filename with extension
                    $filenamewithextension = $File->getClientOriginalName();

                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //get file extension
                    $extension = Str::lower($File->getClientOriginalExtension());

                    //filename to store
                    $filenametostore = $filename . '_' . time() . '.' . $extension;


                    if($File->move(public_path('/tmp/'), $filenametostore)){
                        return response()
                            ->json([
                                'file_size' => File::size(public_path('/tmp/'.$filenametostore)),
                                'file_name' => $filenametostore,
                                'original_name' => $File->getClientOriginalName(),
                                'mime_type' => $File->getClientMimeType()
                            ]);
                    }
                }
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'File Extension not supported!']);
            }
        } else {
            return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'No File found or some error during the upload!']);
        }


        }


}
