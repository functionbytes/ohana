<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementCream;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreamsController extends Controller
{

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $creams = StatementCream::descending();

        if ($searchKey) {
            $creams = $creams->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $creams = $creams->where('available', $available);
        }

        $creams = $creams->paginate(paginationNumber());

        return view('managers.views.settings.statements.creams.index')->with([
            'creams' => $creams,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){
        return view('managers.views.settings.statements.creams.create')->with([]);
    }

    public function view($uid){
        $cream = StatementCream::uid($uid);

        return view('managers.views.settings.statements.creams.view')->with([
            'cream' => $cream
        ]);
    }

    public function edit($uid){
        $cream = StatementCream::uid($uid);

        return view('managers.views.settings.statements.creams.edit')->with([
            'cream' => $cream,
        ]);
    }

    public function store(Request $request){
        $cream = new StatementCream;
        $cream->title = $request->title;
        $cream->slug = Str::slug($request->title);
        $cream->available = $request->available;
        $cream->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){
        $cream = StatementCream::uid($request->uid);
        $cream->title = $request->title;
        $cream->slug = Str::slug($request->title);
        $cream->available = $request->available;
        $cream->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);
    }

    public function destroy($uid){
        $cream = StatementCream::uid($uid);
        $cream->delete();

        return redirect()->back();
    }
}