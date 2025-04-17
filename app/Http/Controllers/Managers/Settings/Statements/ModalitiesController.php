<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementModalitie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModalitiesController extends Controller {

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $modalities = StatementModalitie::descending();

        if ($searchKey) {
            $modalities = $modalities->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $modalities = $modalities->where('available', $available);
        }

        $modalities = $modalities->paginate(paginationNumber());

        return view('managers.views.settings.statements.modalities.index')->with([
            'modalities' => $modalities,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.modalities.create')->with([]);

    }

    public function view($uid){

        $modalitie = StatementModalitie::uid($uid);

        return view('managers.views.settings.statements.modalities.view')->with([
            'modalitie' => $modalitie
        ]);
    }

    public function edit($uid){

        $modalitie = StatementModalitie::uid($uid);

        return view('managers.views.settings.statements.modalities.edit')->with([
            'modalitie' => $modalitie,
        ]);
    }

    public function store(Request $request){

        $exists = StatementModalitie::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $modalitie = new StatementModalitie;
        $modalitie->title = $request->title;
        $modalitie->slug = Str::slug($request->title);
        $modalitie->available = $request->available;
        $modalitie->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){

        $modalitie = StatementModalitie::uid($request->uid);

        $exists = StatementModalitie::where('title', $request->title)
            ->where('id', '!=', $modalitie->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $modalitie->title = $request->title;
        $modalitie->slug = Str::slug($request->title);
        $modalitie->available = $request->available;
        $modalitie->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $modalitie = StatementModalitie::uid($uid);
        $modalitie->delete();

        return redirect()->back();

    }
}