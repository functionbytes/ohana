<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Statement\StatementEmployment;

class EmploymentsController extends Controller {

    public function index(Request $request){
        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $employments = StatementEmployment::descending();

        if ($searchKey) {
            $employments = $employments->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $employments = $employments->where('available', $available);
        }

        $employments = $employments->paginate(paginationNumber());

        return view('managers.views.settings.statements.employments.index')->with([
            'employments' => $employments,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);
    }

    public function create(){
        return view('managers.views.settings.statements.employments.create')->with([]);
    }

    public function view($uid){
        $employment = StatementEmployment::uid($uid);

        return view('managers.views.settings.statements.employments.view')->with([
            'employment' => $employment
        ]);
    }

    public function edit($uid){
        $employment = StatementEmployment::uid($uid);

        return view('managers.views.settings.statements.employments.edit')->with([
            'employment' => $employment,
        ]);
    }

    public function store(Request $request){
        $exists = StatementEmployment::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $employment = new StatementEmployment;
        $employment->title = $request->title;
        $employment->slug = Str::slug($request->title);
        $employment->available = $request->available;
        $employment->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){
        $employment = StatementEmployment::uid($request->uid);

        $exists = StatementEmployment::where('title', $request->title)
            ->where('id', '!=', $employment->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $employment->title = $request->title;
        $employment->slug = Str::slug($request->title);
        $employment->available = $request->available;
        $employment->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);
    }

    public function destroy($uid){
        $employment = StatementEmployment::uid($uid);
        $employment->delete();

        return redirect()->back();
    }
}