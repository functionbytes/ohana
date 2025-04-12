<?php

namespace App\Http\Controllers\Managers\Distributors;

use App\Models\Invoice\NoteCondition;
use App\Models\Delegation\Delegation;
use App\Models\Invoice\InvoiceMethod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{

    public function index(Request $request , $slack){

        $searchKey = null ?? $request->search;
        $condition = null ?? $request->condition;
        $type = null ?? $request->type;
        $method = null ?? $request->methods;

        $invoices = Delegation::uid($uid)->invoices()->orderBy("number","desc");
        $methods = InvoiceMethod::latest()->get();
        $conditions = NoteCondition::latest()->get();

        if ($searchKey) {
            $invoices = $invoices->where('reference', 'like', '%' . $searchKey . '%');
        }

        if ($method) {
            $invoices = $invoices->where('method_id', $method);
        }

        if ($condition) {
            $invoices = $invoices->where('condition_id', $condition);
        }

        $invoices = $invoices->paginate(paginationNumber());

        return view('managers.views.invoices.invoices.index')->with([
            'invoices' => $invoices,
            'conditions' => $conditions,
            'condition' => $condition,
            'type' => $type,
            'methods' => $methods,
            'method' => $method,
            'searchKey' => $searchKey,
        ]);

    }

}
