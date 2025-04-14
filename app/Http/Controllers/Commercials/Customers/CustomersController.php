<?php


namespace App\Http\Controllers\Commercials\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Postalcode;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index(Request $request){

        $searchKey = null ?? $request->search;

        $customers = Customer::latest();

        if ($searchKey) {
            $customers->when(!strpos($searchKey, '-'), function ($query) use ($searchKey) {
                $query->where('customers.firstname', 'like', '%' . $searchKey . '%')
                    ->orWhere('customers.lastname', 'like', '%' . $searchKey . '%')
                    ->orWhere(DB::raw("CONCAT(customers.firstname, ' ', customers.lastname)"), 'like', '%' . $searchKey . '%')
                    ->orWhere('customers.email', 'like', '%' . $searchKey . '%')
                    ->orWhere('customers.identification', 'like', '%' . $searchKey . '%');
            });
        }

        $customers = $customers->paginate(paginationNumber());

        return view('commercials.views.customers.customers.index')->with([
            'customers' => $customers,
            'searchKey' => $searchKey,
        ]);
    }
    public function create()
    {
        $postalcodes = Postalcode::get()->prepend('', '')->pluck('code', 'id');

        return view('commercials.views.customers.customers.create')->with([
            'postalcodes' => $postalcodes,
        ]);

    }

    public function store(Request $request)
    {

        $validates = Customer::where('email', $request->email)->orWhere('identification', $request->identification)->exists();

        if($validates){

            $email =  Customer::where('email', $request->email)->exists();

            if($email){
                $response = [
                    'success' => false,
                    'message' => 'El correo electronico ya estan regitrada en nuestro sistema',
                ];

                return response()->json($response);
            }

        }else{

            $customer = new Customer;
            $customer->firstname = Str::upper($request->firstname);
            $customer->lastname  = Str::upper($request->lastname);
            $customer->identification = $request->identification;
            $customer->email = $request->email;
            $customer->cellphone = $request->cellphone;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->secondaddress = $request->secondaddress;
            $customer->comments = $request->comments;
            $customer->parish = $request->parish;
            $customer->iban = $request->iban;
            $customer->postalcode_id = $request->postalcode;
            $customer->save();

            $response = [
                'success' => true,
                'message' => '',
            ];

            return response()->json($response);

        }

    }

    public function view($uid)
    {
        $customer = Customer::uid($uid);

        $postalcodes = Postalcode::get()->prepend('', '')->pluck('code', 'id');

        return view('commercials.views.customers.customers.view')->with([
            'customer' => $customer,
            'postalcodes' => $postalcodes,
        ]);

    }
    public function edit($uid)
    {
        $customer = Customer::with('postalcode.city.province')->uid($uid);
        $postalcodes = Postalcode::get()->prepend('', '')->pluck('code', 'id');

        return view('commercials.views.customers.customers.edit')->with([
            'customer' => $customer,
            'postalcodes' => $postalcodes,
        ]);

    }
    public function update(Request $request)
    {
        $customer = Customer::uid($request->uid);

        if ($customer->cellphone !== $request->cellphone && Customer::where('cellphone', $request->cellphone)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'El telefono ya está registrado en nuestro sistema',
            ]);
        }

        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname  = Str::upper($request->lastname);
        $customer->identification = $request->identification;
        $customer->email = $request->email;
        $customer->cellphone = $request->cellphone;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->secondaddress = $request->secondaddress;
        $customer->comments = $request->comments;
        $customer->parish = $request->parish;
        $customer->iban = $request->iban;
        $customer->null = $request->null;
        $customer->update();

        return response()->json([
            'success' => true,
            'message' => 'Cliente actualizado correctamente',
        ]);
    }

    public function destroy($uid)
    {
        $customer = Customer::uid($uid);
        $customer->delete();
        return redirect()->route('teleoperator.customers');

    }

}
