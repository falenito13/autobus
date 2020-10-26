<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Files;
use App\Helpers\Helpers;
use App\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Ixudra\Curl\Facades\Curl;
use Validator;

class ContactController extends BaseController
{
    public function index()
    {
        $Route = Route::getCurrentRoute()->getName();
        $meta = Meta::where('type_id','=','10')->first();
        $data = Contact::with(['MainImage'])->find(1);
        return view('front.contact.index',['Route' => $Route, 'Meta' => $meta, 'Data' => $data]);
    }

    public function SendMail(Request $request)
    {

        if ($request->validate([
            'Name' => 'required|string',
            'Email' => 'required|email',
            'Message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ])) {
            $data = [
                'Name' => $request->input('Name'),
                'Message' => $request->input('Message'),
                'Email' => $request->input('Email'),
            ];
            \Mail::send('emails.contact', $data, function ($message) {
                $message->from('noreply@autobus.ge', 'Autobus');
                $message->to('info@autobus.ge');
                $message->subject('Contact Request');
            });
            return Redirect::back()->with('success',\Lang::get('global.message_sent'));

        } else {
            return Redirect::back()->with('error', \Lang::get('global.fill_all_fields'));
        }
    }

    public function SendMailAjax(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'Name' => 'required|string',
                'Email' => 'required|email',
                'Message' => 'required|string',
                'g-recaptcha-response' => 'required|captcha',
            ]
        );

        if ($validator->fails()) {
            return response()
                ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
        } else{
            $data = [
                'Name' => $request->input('Name'),
                'Message' => $request->input('Message'),
                'Email' => $request->input('Email'),
            ];
            try {
                \Mail::send('emails.contact', $data, function ($message) {
                    $message->from('noreply@autobus.ge', 'Autobus');
                    $message->to('info@autobus.ge');
                    //$message->to('irakli.skyline@gmail.com');
                    $message->subject('Sepcial Tour Request');
                });
                return response()
                    ->json(['StatusCode' => 1,
                        'StatusMessage' => 'ოპერაცია წარმატებით დასრულდა!']);
            } catch (\Exception $e){
                return response()
                    ->json(['StatusCode' => 0,
                        'StatusMessage' => 'დაფიქსირდა შეცდომა მეილის გაგზავნისას!']);
            }

        }
    }

    public function ContactById($PostID){
        $max_files = 1;
        $item = Contact::find($PostID);
        $Files = Files::where('route_id', $PostID)
            ->where('route_name', 'contact')
            ->get()->toJson();

        return view('admin.contact.edit',
            ['max_files' => $max_files,'item' => $item,'Files' => $Files]);
    }

    public function EditContactPost(Request $request)
    {
        $Route = 'contact';
        $ID = $request->input('ID');
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $address = [];

        foreach ($supportedLocalekeys as $localekey) {
            $address[$localekey] = $request->input('Address-' . $localekey);
        }

        $Item = new Contact;
        $Contact = $Item::find($ID);
        $Contact->phone = $request->input('Phone');
        $Contact->email = $request->input('Email');
        $Contact->fb_link = $request->input('fb_link');
        $Contact->ins_link = $request->input('ins_link');
        $Contact->ln_link = $request->input('ln_link');
        $Contact->setTranslations('address', $address);

        if ($Contact->save()){
            if ($request->has('File')) {
                if (Helpers::RemoveFiles($Route, $Contact->id)) {
                    foreach ($request->File as $image){
                        Helpers::UploadImages($image,$Contact->id,$Route);
                    }
                } else {
                    return response()
                        ->json(['StatusCode' => 0,
                            'StatusMessage' => 'დაფიქსირდა შეცდომა ფაილების წაშლისას!']);
                }

            } elseif($request->file('File') == null || !$request->file('File')){
                Helpers::RemoveFiles($Route,$Contact->id);
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
