<?php

namespace App\Http\Controllers\Managers\Settings\Statements;

use App\Models\Statement\StatementPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentsController extends Controller {

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $payments = StatementPayment::descending();

        if ($searchKey) {
            $payments = $payments->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $payments = $payments->where('available', $available);
        }

        $payments = $payments->paginate(paginationNumber());

        return view('managers.views.settings.statements.payments.index')->with([
            'payments' => $payments,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        return view('managers.views.settings.statements.payments.create')->with([]);

    }

    public function view($uid){

        $payment = StatementPayment::uid($uid);

        return view('managers.views.settings.statements.payments.view')->with([
            'payment' => $payment
        ]);
    }

    public function edit($uid){
        
        $payment = StatementPayment::uid($uid);

        return view('managers.views.settings.statements.payments.edit')->with([
            'payment' => $payment,
        ]);
    }

    public function store(Request $request){
        
        $exists = StatementPayment::where('title', $request->title)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $payment = new StatementPayment;
        $payment->title = $request->title;
        $payment->slug = Str::slug($request->title);
        $payment->available = $request->available;
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Se ha creado correctamente',
        ]);
    }

    public function update(Request $request){

        $payment = StatementPayment::uid($request->uid);

        $exists = StatementPayment::where('title', $request->title)
            ->where('id', '!=', $payment->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe un registro con ese título.',
            ]);
        }

        $payment->title = $request->title;
        $payment->slug = Str::slug($request->title);
        $payment->available = $request->available;
        $payment->update();

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizo correctamente',
        ]);

    }

    public function destroy($uid){

        $payment = StatementPayment::uid($uid);
        $payment->delete();

        return redirect()->back();

    }
}