<?php

namespace App\Http\Controllers\Managers\Delegations;

use App\Http\Controllers\Controller;
use App\Models\Delegation\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DelegationsController extends Controller
{

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $delegations = Delegation::descending();

        if ($searchKey) {
            $delegations = $delegations->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $delegations = $delegations->where('available', $available);
        }

        $delegations = $delegations->paginate(paginationNumber());

        return view('managers.views.delegations.delegations.index')->with([
            'delegations' => $delegations,
            'available' => $available,
            'searchKey' => $searchKey,
        ]);

    }

    public function create(){

        $availables = collect([
            ['id' => '1', 'label' => 'Publico'],
            ['id' => '0', 'label' => 'Oculto'],
        ]);

        $availables = $availables->pluck('label','id');

        $generates = collect([
            ['id' => '1', 'label' => 'Si'],
            ['id' => '0', 'label' => 'No'],
        ]);

        $generates = $generates->pluck('label','id');

        return view('managers.views.delegations.delegations.create')->with([
            'availables' => $availables,
            'generates' => $generates,
        ]);

    }

    public function edit($uid){

            $delegation = Delegation::uid($uid);

            $availables = collect([
                ['id' => '1', 'label' => 'Publico'],
                ['id' => '0', 'label' => 'Oculto'],
            ]);

            $availables = $availables->pluck('label','id');

            $generates = collect([
                    ['id' => '1', 'label' => 'Si'],
                    ['id' => '0', 'label' => 'No'],
            ]);

            $generates = $generates->pluck('label','id');

           return view('managers.views.delegations.delegations.edit')->with([
               'availables' => $availables,
               'generates' => $generates,
               'delegation' => $delegation,
           ]);

    }

    public function update(Request $request)
    {
        $delegation = Delegation::uid($request->uid);

        $delegation->title = Str::upper($request->title);
        $delegation->slug = Str::slug($request->title, '-');
        $delegation->address = $request->address;
        $delegation->available = $request->available;
        $delegation->save();

        return response()->json([
            'success' => true,
            'message' => 'Delegación actualizado correctamente.',
        ]);


    }

    public function store(Request $request){

        $validates = Delegation::where('title', $request->title)->get();

        if (count($validates)>0) {

                $title =  Delegation::where('title', $request->title)->get();

                if(count($title)>0){

                    return response()->json([
                        'success' => false,
                        'message' => 'El titulo ya estan regitrada en nuestro sistema',
                    ]);

                }

            }else{

                    $delegation = new Delegation;
                    $delegation->title = Str::upper($request->title);
                    $delegation->slug  = Str::slug($request->title, '-');
                    $delegation->address = $request->address;
                    $delegation->available = 1;
                    $delegation->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Delegación se creo correctamente.',
                    ]);

            }
   }

   public function destroy($uid){

       $delegation = Delegation::uid($uid);
       $delegation->delete();

       return redirect()->route('manager.delegations');
   }

    public function navegation($uid){

        $delegation = Delegation::uid($uid);

        return view('managers.views.delegations.delegations.navegation')->with([
            'delegation' => $delegation,
        ]);

    }

}
