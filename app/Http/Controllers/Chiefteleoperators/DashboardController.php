<?php

namespace App\Http\Controllers\Chiefteleoperators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note\Note;
use Carbon\Carbon;
use Auth;
use Mail;

class DashboardController extends Controller
{

    public function dashboard(Request $request){

        $notes = Note::get();

        return view('chiefteleoperators.views.dashboard.index')->with([
            'notes' => $notes,
        ]);

    }


}
