<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MethodsController extends Controller {

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $methods = StatementMethod::descending();

        if ($searchKey) {
            $methods = $methods->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $methods = $methods->where('available', $available);
        }

        $methods = $methods->paginate(paginationNumber());

        return view('managers.views.settings.statements.methods.index')->with([
            'methods' => $methods,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.methods.create')->with([]);

    }

    public function view($uid){

        $method = StatementMethod::uid($uid);

        return view('managers.views.settings.statements.methods.view')->with([
            'method' => $method
        ]);
    }

    public function edit($uid){
        
        $method = StatementMethod::uid($uid);

        return view('managers.views.settings.statements.methods.edit')->with([
            'method' => $method,
        ]);
    }

    public function store(Request $request){
        
        $exists = StatementMethod::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $method = new StatementMethod;
        $method->title = $request->title;
        $method->slug = Str::slug($request->title);
        $method->available = $request->available;
        $method->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){

        $method = StatementMethod::uid($request->uid);

        $exists = StatementMethod::where('title', $request->title)
            ->where('id', '!=', $method->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $method->title = $request->title;
        $method->slug = Str::slug($request->title);
        $method->available = $request->available;
        $method->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $method = StatementMethod::uid($uid);
        $method->delete();

        return redirect()->back();

    }
}