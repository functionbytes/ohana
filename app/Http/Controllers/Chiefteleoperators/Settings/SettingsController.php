<?php

namespace App\Http\Controllers\chiefteleoperators\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class SettingsController extends Controller
{
    public function profile(){

        $user = User::auth();

        return view('chiefteleoperators.views.settings.profile.setting')->with([
            'user' => $user
        ]);
    }
    public function update(Request $request) {

        $user = User::uid($request->uid);

        if($user->email != $request->email || $user->identification != $request->identification){

            $validates = User::where('email', $request->email)->orWhere('identification', $request->identification)->get();

            if (count($validates)>0) {

                $email =  User::where('email', $request->email)->get();

                if(count($email)>0){

                    if($user->email != $request->email){

                        $response = [
                            'success' => false,
                            'message' => 'El correo electronico ya estan regitrada en nuestro sistema',
                        ];

                        return response()->json($response);
                    }

                }

                $user = User::uid($request->uid);
                $user->firstname = Str::upper($request->firstname);
                $user->lastname = Str::upper($request->lastname);
                $user->email = $request->email;
                $request->password != null ? $user->password = $request->password : null;
                $user->update();

                return response()->json([
                    'success' => true,
                    'message' => 'Se ha actualizado correctamente.'
                ]);

            }

        }else {

            $user = User::uid($request->uid);
            $user->firstname = Str::upper($request->firstname);
            $user->lastname = Str::upper($request->lastname);
            $user->support = Str::upper($request->support);
            $user->email = $request->email;
            $request->password != null ? $user->password = $request->password : null;
            $user->update();

            return response()->json([
                'success' => true,
                'message' => 'Se ha actualizado correctamente.'
            ]);
        }


    }

}
