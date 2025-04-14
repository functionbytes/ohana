<?php

namespace App\Http\Controllers\Chiefteleoperators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postalcode;

class PostalcodeController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('q');

        $postalcodes = Postalcode::with(['city.province'])
            ->where('code', 'like', "%$search%")
            ->orWhereHas('city', function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            })
            ->limit(20)
            ->get()
            ->map(function ($pc) {
                $city = $pc->city->title ?? '-';
                $province = $pc->city->province->title ?? '-';
                return [
                    'id' => $pc->id,
                    'text' => "{$pc->code} - {$pc->title} ({$city}, {$province})"
                ];
            });



        return response()->json($postalcodes);
    }
}
