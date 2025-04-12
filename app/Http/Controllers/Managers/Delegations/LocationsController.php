<?php

namespace App\Http\Controllers\Managers\Delegations;

use App\Http\Controllers\Controller;
use App\Models\Location\Location;
use App\Models\Delegation\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationsController extends Controller
{

    public function index(Request $request,$uid)
    {
        $searchKey = null ?? $request->search;
        $available = null ?? $request->available;

        $delegation = Delegation::uid($uid);
        $locations = $delegation->locations();

        if ($searchKey) {
            $locations = $locations->where('title', 'like', '%' . $searchKey . '%');
        }

        if ($request->available != null) {
            $locations = $locations->where('available', $available);
        }

        $locations = $locations->paginate(paginationNumber());


        return view('managers.views.delegations.locations.index')->with([
            'delegation' => $delegation,
            'locations' => $locations,
        ]);

    }
    public function create($uid){

        $delegation = Delegation::uid($uid);

        return view('managers.views.delegations.locations.create')->with([
            'delegation' => $delegation,
        ]);

    }

    public function edit($uid){

        $location = Location::uid($uid);
        $delegation = $location->delegation;

        return view('managers.views.delegations.locations.edit')->with([
            'location' => $location,
            'delegation' => $delegation,
        ]);

    }

    public function update(Request $request)
    {
        $location = Location::uid($request->uid);

        $location->title = Str::upper($request->title);
        $location->slug = Str::slug($request->title, '-');
        $location->address = $request->address;
        $location->available = $request->available;
        $location->save();

        return response()->json([
            'success' => true,
            'message' => 'Delegación actualizado correctamente.',
        ]);


    }

    public function store(Request $request){

        $validates = Location::where('title', $request->title)->get();

        if (count($validates)>0) {

            $title =  Location::where('title', $request->title)->get();

            if(count($title)>0){

                return response()->json([
                    'success' => false,
                    'message' => 'El titulo ya estan regitrada en nuestro sistema',
                ]);

            }

        }else{

            $location = new Location;
            $location->title = Str::upper($request->title);
            $location->slug  = Str::slug($request->title, '-');
            $location->address = $request->address;
            $location->delegation_id = $request->delegation;
            $location->available = 1;
            $location->save();

            return response()->json([
                'success' => true,
                'message' => 'Delegación se creo correctamente.',
            ]);

        }
    }

    public function destroy($uid){

        $location = Location::uid($uid);
        $location->delete();

        return redirect()->route('manager.locations');
    }

    public function navegation($uid){

        $location = Location::uid($uid);

        return view('managers.views.delegations.locations.navegation')->with([
            'location' => $location,
        ]);

    }


}
