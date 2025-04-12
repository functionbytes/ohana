<?php

namespace App\Http\Controllers\Managers\Distributors;

use App\Models\Delegation\Delegation;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderCondition;
use App\Models\Order\OrderMethod;
use App\Models\Order\OrderType;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request,$slack){

        $searchKey = null ?? $request->search;
        $condition = null ?? $request->condition;
        $type = null ?? $request->type;
        $method = null ?? $request->methods;

        $orders = Delegation::uid($uid)->orders()->latest();
        $methods = OrderMethod::latest()->get();
        $conditions = OrderCondition::latest()->get();
        $types = OrderType::latest()->get();

        if ($searchKey) {
            $orders = $orders->where('slack', 'like', '%' . $searchKey . '%');
        }

        if ($method) {
            $orders = $orders->where('method_id', $method);
        }

        if ($condition) {
            $orders = $orders->where('condition_id', $condition);
        }

        if ($type) {
            $orders = $orders->where('type_id', $type);
        }

        $orders = $orders->paginate(paginationNumber());

        return view('managers.views.distributors.orders.index')->with([
            'orders' => $orders,
            'conditions' => $conditions,
            'condition' => $condition,
            'types' => $types,
            'type' => $type,
            'methods' => $methods,
            'method' => $method,
            'searchKey' => $searchKey,
        ]);
    }

}
