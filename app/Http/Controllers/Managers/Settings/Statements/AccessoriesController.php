<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Http\Controllers\Controller;
use App\Models\Statement\StatementAccessorie;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $accessories = StatementAccessorie::descending();

        if ($searchKey) {
            $accessories = $accessories->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $accessories = $accessories->where('available', $available);
        }

        $accessories = $accessories->paginate(paginationNumber());

        return view('managers.views.settings.statements.accessories.index')->with([
            'accessories' => $accessories,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.accessories.create')->with([

        ]);

    }

    public function view($uid){

        $accessorie = StatementAccessorie::uid($uid);

        return view('managers.views.settings.statements.accessories.view')->with([
            'accessorie' => $accessorie
        ]);

    }

    public function edit($uid){

        $accessorie = StatementAccessorie::uid($uid);

        return view('managers.views.settings.statements.accessories.edit')->with([
            'accessorie' => $accessorie,
        ]);

    }

    public function store(Request $request){

        $accessorie = new StatementAccessorie;
        $accessorie->title = $request->title;
        $accessorie->available = $request->available;
        $accessorie->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);

    }

    public function update(Request $request){

        $accessorie = StatementAccessorie::uid($request->uid);
        $accessorie->title = $request->title;
        $accessorie->available = $request->available;
        $accessorie->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $accessorie = StatementAccessorie::uid($uid);
        $accessorie->delete();

        return redirect()->back();

    }





}
