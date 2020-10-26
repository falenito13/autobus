<?php

namespace App\Http\Controllers;

use App\Category;
use App\Location;
use App\Orders;
use App\Rules\MatchOldPassword;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return View('auth.Home.index', ['User'=>$user]);
    }
    public function history(){
        $user = Auth::user();
        $orders = Orders::where('email', $user->email)->where('payed', 1)->get();
        return View('auth.Home.history', ['User' => $user ,'Order' => $orders]);
    }

    public function UserOrderById(Request $request){
        $Order = Orders::where('email', Auth::user()->email)->where('id', $request->orderid)->first();
        if ($Order->type == 1 && $Order->Route_or_tour_id == 0){
            $location = '<td>'.$Order->location_from.' - '.$Order->location_to.'</td>';
        }
        else{
            $location = '<td>'.$Order->Route_or_tour_id.'('.Lang::get('global.tour').')</td>';
        }
        if($Order->return_date != NULL){
            $return_date = '<tr>
                                 <th>'.Lang::get('global.return_date').'</th>
                                 <td>'.Date::parse($Order->return_date)->format('j F Y').' - '.$Order->return_pickup.'</td>
                              </tr>';
            } else {
            $return_date = '';
        }
        if ($Order->adult > 0){
            $adult = '<tr>
                                     <th>'.Lang::get('global.adult').'</th>
                                    <td>'.$Order->adult.'</td>
                                </tr>';
            } else {
            $adult = '';
        }
        if ($Order->infant > 0){
            $infant = '<tr>
                                  <th>'.Lang::get('global.infant').'</th>
                                  <td>'.$Order->infant.'</td>
                              </tr>';
        } else {
            $infant = '';
        }
        if ($Order->convertible > 0){
            $convertible = '<tr>
                                   <th>'.Lang::get('global.convertible').'</th>
                                   <td>'.$Order->convertible.'</td>
                                </tr>';
        } else {
            $convertible = '';
        }
        if ($Order->booster > 0){
            $booster = '<tr>
                                     <th>'.Lang::get('global.booster').'</th>
                                     <td>'.$Order->booster.'</td>
                                </tr>';
        } else {
            $booster = '';
        }
        if ($Order->comment != NULL){
            $comment = '<tr>
                                   <th>'.Lang::get('global.comment').'</th>
                                   <td>'.$Order->comment.'</td>
                                </tr>';
        } else {
            $comment = '';
        }
        return $html = '<div class="table-responsive" style="clear: both;">
                     <table class="table table-hover">
                         <tr>
                             <th>'.Lang::get('global.location').'</th>'.
                            $location
                         .'</tr>
                         <tr>
                             <th>'.Lang::get('global.transfer_date').'</th>
                             <td>'.Date::parse($Order->start_date)->format('j F Y').' - '.$Order->start_pickup.'</td>
                          </tr>'.
                            $return_date

                            .'<tr>
                               <th>'.Lang::get('global.tr_type').'</th>
                               <td>'.$Order->transport_type_id.'</td>
                            </tr>'.
                            $adult.
                            $infant.
                            $convertible.
                            $booster.
                            $comment.
                     '</table>
               </div>
               <div class="col-md-12">
                   <div class="pull-right m-t-30 text-right">
                      <hr>
                      <h3><b>'.Lang::get('global.total').' : </b>'.$Order->price.'₾</h3> </div>
               </div>';
    }

    public function EditUser(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|min:8',
            'lastname' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
        }

        $users = new User;
        $user = $users->find(Auth::user()->id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->mobile_number = $request->phone_number;

        if ($user->save()){
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით შესრულდა!!']);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა!!']);
    }

    public function ChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'current_password' => ['string', new MatchOldPassword],
            'new_password' => 'required|string',
            'new_confirm_password' => 'same:new_password|required|string',
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
        }
        if (User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)])){
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით შესრულდა!!']);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'დაფიქსირდა შეცდომა!!']);
    }

}
