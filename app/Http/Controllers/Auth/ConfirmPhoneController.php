<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class ConfirmPhoneController extends Controller
{

    public function index(Request $request){

        $validated = $request->validate([
            'confirmNumber' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);


      $user = User::where('phone',$request->phone)->first();


      if($user->phone_verified_at == $request->confirmNumber ){

          $user->update([
              'phone_verified_at' =>  Carbon::now(),
          ]);
          $user->save();

      }else {

          return response()->json(['errors' => ['name' => ['Неверный код']]], 422);
      }

        Auth::guard()->login($user);

        return $user;


    }


}
