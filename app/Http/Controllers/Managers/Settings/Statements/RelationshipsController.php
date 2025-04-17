<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementRelationship;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RelationshipsController extends Controller {

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $relationships = StatementRelationship::descending();

        if ($searchKey) {
            $relationships = $relationships->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $relationships = $relationships->where('available', $available);
        }

        $relationships = $relationships->paginate(paginationNumber());

        return view('managers.views.settings.statements.relationships.index')->with([
            'relationships' => $relationships,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.relationships.create')->with([]);

    }

    public function view($uid){

        $relationship = StatementRelationship::uid($uid);

        return view('managers.views.settings.statements.relationships.view')->with([
            'relationship' => $relationship
        ]);
    }

    public function edit($uid){
        
        $relationship = StatementRelationship::uid($uid);

        return view('managers.views.settings.statements.relationships.edit')->with([
            'relationship' => $relationship,
        ]);
    }

    public function store(Request $request){
        
        $exists = StatementRelationship::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $relationship = new StatementRelationship;
        $relationship->title = $request->title;
        $relationship->slug = Str::slug($request->title);
        $relationship->available = $request->available;
        $relationship->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){

        $relationship = StatementRelationship::uid($request->uid);

        $exists = StatementRelationship::where('title', $request->title)
            ->where('id', '!=', $relationship->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $relationship->title = $request->title;
        $relationship->slug = Str::slug($request->title);
        $relationship->available = $request->available;
        $relationship->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $relationship = StatementRelationship::uid($uid);
        $relationship->delete();

        return redirect()->back();

    }
}