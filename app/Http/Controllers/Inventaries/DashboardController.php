<?php

namespace App\Http\Controllers\Inventaries;

use App\Http\Controllers\Controller;
use App\Models\Location\Location;
use App\Models\Subscriber;
use App\Structure\Elements;

class DashboardController extends Controller
{
    public function dashboard(){

        return view('inventaries.views.dashboard.index')->with([
        ]);

    }

}
