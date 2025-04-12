<?php

namespace App\Http\Controllers\Managers\Distributors;

use App\Models\Delegation\DistributorCourse;
use App\Models\Delegation\Delegation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class RatesController extends Controller
{
    public function index(Request $request,$slack){

        $distributor = Delegation::uid($uid);

        $rates = $distributor->rates;

        return view('managers.views.distributors.rates.index')->with([
            'distributor' => $distributor,
            'rates' => $rates,
        ]);

    }

    public function update(Request $request){

        $distributor = Delegation::uid($request->uid);

        if (!$distributor) {
            return response()->json([
                'success' => false,
                'message' => 'Distribuidor no encontrado.',
            ]);
        }

        $updated = false;
        foreach ($request->courses as $id => $price) {
            $course = DistributorCourse::find($id);

            if ($course) {
                $course->price = $price;
                $course->save();
                $updated = true;
            } else {

                return response()->json([
                    'success' => false,
                    'message' => 'Curso no encontrado: ' . $id,
                ]);

            }
        }

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Precios de los cursos actualizados exitosamente.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se actualizaron los cursos.',
        ]);


    }


}
