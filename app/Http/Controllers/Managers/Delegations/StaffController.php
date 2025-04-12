<?php

namespace App\Http\Controllers\Managers\Distributors;

use App\Models\Delegation\DelegationEmployee;
use App\Models\Delegation\Delegation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index(Request $request, $slack){

        $distributor = Delegation::uid($uid);
        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $users = $distributor->staffs()->orderBy('updated_at', 'desc');

        if ($searchKey) {
            $users = $users->where(function($query) use ($searchKey) {
                $query->where('users.firstname', 'like', '%' . $searchKey . '%')
                    ->orWhere('users.lastname', 'like', '%' . $searchKey . '%')
                    ->orWhere(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'like', '%' . $searchKey . '%')
                    ->orWhere('users.email', 'like', '%' . $searchKey . '%')->orWhere('users.identification', 'like', '%' . $searchKey . '%');
            });
        }

        if ($available != null) {
            $users = $users->where('users.available', $available);
        }

        $users = $users->paginate(paginationNumber());

        return view('managers.views.distributors.staffs.index')->with([
            'users' => $users,
            'distributor' => $distributor,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }
    public function create($uid){

        $distributor = Delegation::uid($uid);

        $availables = collect([
            ['id' => '1', 'label' => 'Activo'],
            ['id' => '0', 'label' => 'Inactivo'],
        ]);

        $availables = $availables->pluck('label', 'id');

        return view('managers.views.distributors.staffs.create')->with([
            'distributor' => $distributor,
            'availables' => $availables,
        ]);

    }
    public function edit($uid){

        $user = User::uid($uid);

        $distributor = $user->relationsDistributor;

        $availables = collect([
            ['id' => '1', 'label' => 'Activo'],
            ['id' => '0', 'label' => 'Inactivo'],
        ]);

        $availables = $availables->pluck('label', 'id');

        return view('managers.views.distributors.staffs.edit')->with([
            'user' => $user,
            'distributor' => $distributor,
            'availables' => $availables,
        ]);
    }
    public function view($uid) {

        $user = User::uid($uid);

        $availables = collect([
            ['id' => '1', 'label' => 'Activo'],
            ['id' => '0', 'label' => 'Inactivo'],
        ]);

        $availables = $availables->pluck('label', 'id');

        return view('managers.views.distributors.staffs.view')->with([
            'user' => $user,
            'availables' => $availables,
        ]);
    }
    public function history($uid){
        $user = User::uid($uid);

        return view('managers.views.distributors.staffs.history')->with([
            'user' => $user,
        ]);

    }
    public function update(Request $request){

        $user = User::uid($request->uid);

        if ($user->email != $request->email || $user->identification != $request->identification) {

            $validates = User::where('email', $request->email)->orWhere('identification', $request->identification)->get();

            if (count($validates) > 0) {

                $email =  User::where('email', $request->email)->get();


                if (count($email) > 0) {

                    if ($user->email != $request->email) {

                        return response()->json([
                            'success' => false,
                            'message' => 'El correo electronico ya estan regitrada en nuestro sistema',
                        ]);
                    }
                }

                $identification =  User::where('identification', $request->identification)->get();

                if (count($identification) > 0) {
                    if ($user->identification != $request->identification) {

                        return response()->json([
                            'success' => false,
                            'message' => 'El nit ya estan regitrada en nuestro sistema',
                        ]);

                    }
                }

                $user = User::uid($request->uid);
                $user->firstname = Str::upper($request->firstname);
                $user->lastname = Str::upper($request->lastname);
                $user->cellphone = $request->cellphone;
                $user->email = $request->email;
                $user->address = $request->address;
                $user->company = $request->company;
                $user->available = $request->available;
                $user->identification = $request->identification;
                $request->password != null ? $user->password = $request->password : null;

                $user->update();

                return response()->json([
                    'success' => true,
                    'message' =>  'El empleado se actaulizo correctamente.',
                ]);

            }
        } else {

            $user = User::uid($request->uid);
            $user->firstname = Str::upper($request->firstname);
            $user->lastname = Str::upper($request->lastname);
            $user->cellphone = $request->cellphone;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->company = $request->company;
            $user->available = $request->available;
            $user->identification = $request->identification;
            $request->password != null ? $user->password = $request->password : null;
            $user->update();

            return response()->json([
                'success' => true,
                'message' =>  'El empleado se actaulizo correctamente.',
            ]);

        }
    }
    public function store(Request $request){

        $distributor = Delegation::slack($request->distributor);

        $validates = User::where('email', $request->email)->orWhere('identification', $request->identification)->get();

        if (count($validates) > 0) {

            $email =  User::where('email', $request->email)->get();

            if (count($email) > 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'El correo electronico ya estan regitrada en nuestro sistema',
                ]);

            }

            $identification =  User::where('identification', $request->identification)->get();

            if (count($identification) > 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'El nit ya estan regitrada en nuestro sistema',
                ]);

            }

        } else {

            $user = new User;
            $user->slack = $this->generate_slack('users');
            $user->firstname = Str::upper($request->firstname);
            $user->lastname =  Str::upper($request->lastname);
            $user->cellphone = $request->cellphone;
            $user->identification = $request->identification;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->password = $request->password;
            $user->available = 1;
            $user->role = 'distributor';
            $user->terms = 1;
            $user->page = 0;
            $user->setting = 0;
            $user->validation = 1;
            $user->email_verified_at = Carbon::now()->setTimezone('America/Bogota');
            $user->save();

            $inscription = new DelegationEmployee;
            $inscription->user_id = $user->id;
            $inscription->distributor_id = $distributor->id;
            $inscription->available = 1;
            $inscription->created_at = Carbon::now()->setTimezone('America/Bogota');
            $inscription->updated_at = Carbon::now()->setTimezone('America/Bogota');
            $inscription->save();

            return response()->json([
                'success' => true,
                'message' =>  'El empleado se creo correctamente.',
            ]);


        }
    }
    public function destroy($uid){

        $user = User::uid($uid);
        $user->delete();
        return redirect()->back();

    }

}
