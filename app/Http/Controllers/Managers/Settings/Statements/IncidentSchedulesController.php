<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementHousing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IncidentSchedulesController extends Controller {
    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;
        $housings = IncidentSchedules::descending();

        if ($searchKey) {
            $housings = $housings->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $housings = $housings->where('available', $available);
        }

        $housings = $housings->paginate(paginationNumber());

        return view('managers.views.settings.statements.housings.index')->with([
            'housings' => $housings,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }
    public function create(){
        return view('managers.views.settings.statements.housings.create')->with([]);
    }
    public function view($uid){

        $housing = StatementHousing::uid($uid);

        return view('managers.views.settings.statements.housings.view')->with([
            'housing' => $housing
        ]);

    }
    public function edit($uid){

        $housing = StatementHousing::uid($uid);

        return view('managers.views.settings.statements.housings.edit')->with([
            'housing' => $housing
        ]);

    }
    public function store(Request $request){

        $exists = StatementHousing::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Ya existe un registro con ese título.']);
        }

        $housing = new StatementHousing;
        $housing->title = $request->title;
        $housing->slug = Str::slug($request->title);
        $housing->available = $request->available;
        $housing->save();

        return response()->json(['success' => true, 'message' => 'Se ha creado correctamente']);

    }
    public function update(Request $request){

        $housing = StatementHousing::uid($request->uid);
        $exists = StatementHousing::where('title', $request->title)->where('id', '!=', $housing->id)->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Ya existe un registro con ese título.']);
        }

        $housing->title = $request->title;
        $housing->slug = Str::slug($request->title);
        $housing->available = $request->available;
        $housing->update();

        return response()->json(['success' => true, 'message' => 'Se ha actualizo correctamente']);

    }
    public function destroy($uid){

        $housing = StatementHousing::uid($uid);
        $housing->delete();
        return redirect()->back();

    }

}
