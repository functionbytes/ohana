<?php

namespace App\Http\Controllers\Commercials\Worksessions;

use App\Http\Controllers\Controller;
use App\Models\Worksession;
use Illuminate\Http\Request;

class WorksessionsController extends Controller
{

    public function index(Request $request){

        $commercial = app('commercial');
        $worksessions = $commercial->worksessions();

        $worksessions = $worksessions->paginate(100);

        return view('commercials.views.worksessions.worksessions.index')->with([
            'worksessions' => $worksessions,
        ]);

    }


    public function checkin(Request $request)
    {
        $commercial = app('commercial');
        $today = now()->toDateString();

        $already = Worksession::todayForEmployee($commercial->id)->first();

        if ($already && $already->check_in) {
            return response()->json(['success' => false, 'message' => 'Ya fichaste la entrada hoy']);
        }

        $worksession = $already ?? new Worksession();
        $worksession->employee_id = $commercial->id;
        $worksession->work_date = $today; // ojo aquí: era `workdate`
        $worksession->check_in = now();
        $worksession->save();

        return response()->json(['success' => true, 'message' => 'Entrada registrada']);
    }

    public function checkout(Request $request)
    {
        $commercial = app('commercial');
        $today = now()->toDateString();

        $worksession = Worksession::todayForEmployee($commercial->id)->first(); // 👈 importante

        if (!$worksession) {
            return response()->json(['success' => false, 'message' => 'Primero debes fichar la entrada']);
        }

        if ($worksession->check_out) {
            return response()->json(['success' => false, 'message' => 'Ya fichaste la salida hoy']);
        }

        $worksession->check_out = now();
        $worksession->save();

        return response()->json(['success' => true, 'message' => 'Salida registrada']);
    }


    public function currentStatus()
    {
        $commercial = app('commercial');

        $session = Worksession::todayForEmployee($commercial->id)->first();

        if (!$session) {
            return response()->json(['status' => 'no_session']);
        }

        if ($session->check_in && !$session->check_out) {
            return response()->json(['status' => 'in_progress']);
        }

        if ($session->check_in && $session->check_out) {
            return response()->json(['status' => 'completed']);
        }

        return response()->json(['status' => 'unknown']);
    }


}
