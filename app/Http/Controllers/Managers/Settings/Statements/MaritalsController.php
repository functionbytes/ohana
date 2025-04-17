<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementMarital;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaritalsController extends Controller {

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $maritals = StatementMarital::descending();

        if ($searchKey) {
            $maritals = $maritals->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $maritals = $maritals->where('available', $available);
        }

        $maritals = $maritals->paginate(paginationNumber());

        return view('managers.views.settings.statements.maritals.index')->with([
            'maritals' => $maritals,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.maritals.create')->with([]);

    }

    public function view($uid){

        $marital = StatementMarital::uid($uid);

        return view('managers.views.settings.statements.maritals.view')->with([
            'marital' => $marital
        ]);
    }

    public function edit($uid){
        
        $marital = StatementMarital::uid($uid);

        return view('managers.views.settings.statements.maritals.edit')->with([
            'marital' => $marital,
        ]);
    }

    public function store(Request $request){
        
        $exists = StatementMarital::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $marital = new StatementMarital;
        $marital->title = $request->title;
        $marital->slug = Str::slug($request->title);
        $marital->available = $request->available;
        $marital->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){

        $marital = StatementMarital::uid($request->uid);

        $exists = StatementMarital::where('title', $request->title)
            ->where('id', '!=', $marital->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $marital->title = $request->title;
        $marital->slug = Str::slug($request->title);
        $marital->available = $request->available;
        $marital->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $marital = StatementMarital::uid($uid);
        $marital->delete();

        return redirect()->back();

    }
}