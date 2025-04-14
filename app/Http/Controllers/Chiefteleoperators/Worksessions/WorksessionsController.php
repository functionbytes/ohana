<?php

namespace App\Http\Controllers\chiefteleoperators\Worksessions;

use App\Http\Controllers\Controller;
use App\Models\Worksession;
use Illuminate\Http\Request;

class WorksessionsController extends Controller
{

    public function index(Request $request){

        $teleoperator = app('teleoperator');
        $worksessions = $teleoperator->worksessions();

        $worksessions = $worksessions->paginate(100);

        return view('chiefteleoperators.views.worksessions.worksessions.index')->with([
            'worksessions' => $worksessions,
        ]);

    }


    public function checkin(Request $request)
    {
        $teleoperator = app('teleoperator');
        $today = now()->toDateString();

        $already = Worksession::todayForEmployee($teleoperator->id)->first();

        if ($already && $already->check_in) {
            return response()->json(['success' => false, 'message' => 'Ya fichaste la entrada hoy']);
        }

        $worksession = $already ?? new Worksession();
        $worksession->employee_id = $teleoperator->id;
        $worksession->work_date = $today; // ojo aquí: era `workdate`
        $worksession->check_in = now();
        $worksession->save();

        return response()->json(['success' => true, 'message' => 'Entrada registrada']);
    }

    public function checkout(Request $request)
    {
        $teleoperator = app('teleoperator');
        $today = now()->toDateString();

        $worksession = Worksession::todayForEmployee($teleoperator->id)->first(); // 👈 importante

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
        $teleoperator = app('teleoperator');

        $session = Worksession::todayForEmployee($teleoperator->id)->first();

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
