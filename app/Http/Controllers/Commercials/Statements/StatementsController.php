<?php

namespace App\Http\Controllers\Commercials\Statements;

use App\Models\Statement\StatementAnnotationType;
use App\Models\Statement\StatementRelationship;
use App\Models\Statement\StatementAccessorie;
use App\Models\Statement\StatementAnnotation;
use App\Models\Statement\StatementEmployment;
use App\Models\Statement\StatementModalitie;
use App\Models\Statement\StatementSchedule;
use App\Models\Statement\StatementHousing;
use App\Models\Statement\StatementMarital;
use App\Models\Statement\StatementPayment;
use App\Models\Statement\StatementStatuse;
use App\Models\Statement\StatementMethod;
use App\Models\Statement\StatementCream;
use App\Http\Controllers\Controller;
use App\Models\Statement\Statement;
use Illuminate\Support\Facades\DB;
use App\Models\Note\NoteHistorie;
use App\Models\Note\NoteSchedule;
use App\Models\Note\NoteStatuses;
use App\Models\Product\Product;
use App\Models\Bundle\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Postalcode;
use App\Models\Note\Note;
use App\Models\Customer;
use GeoIP;

class StatementsController extends Controller
{

    public function index(Request $request){

        $searchKey = null ?? $request->search;
        $notes = Note::latest();
        $statuses = NoteStatuses::available()->get();
        $status = null ?? $request->status;

        if ($searchKey) {
            $notes->when(!strpos($searchKey, '-'), function ($query) use ($searchKey) {
                $query->where('notes.firstname', 'like', '%' . $searchKey . '%')
                    ->orWhere('notes.lastname', 'like', '%' . $searchKey . '%')
                    ->orWhere(DB::raw("CONCAT(notes.firstname, ' ', notes.lastname)"), 'like', '%' . $searchKey . '%')
                    ->orWhere('notes.email', 'like', '%' . $searchKey . '%');
            });
        }

        if ($status != null) {
            $notes = $notes->where('status_id', $status);
        }


        $notes = $notes->paginate(100);

        return view('commercials.views.statements.statements.index')->with([
            'notes' => $notes,
            'searchKey' => $searchKey,
            'statuses' => $statuses,
            'status' => $status,
        ]);

    }
    public function edit($uid){

        $note = Note::uid($uid);
        $customer = Customer::with('postalcode.city.province')->uid($note->customer->uid);
        $status = NoteStatuses::get()->prepend('', '')->pluck('title', 'id');
        $schedules = NoteSchedule::get()->prepend('', '')->pluck('title', 'id');
        $last = NoteHistorie::lastByNote($note->id)->first();

        return view('commercials.views.statements.statements.edit')->with([
            'note' => $note,
            'customer' => $customer,
            'status' => $status,
            'schedules' => $schedules,
            'last' => $last,
        ]);

    }

    public function view($uid){

        $note = Note::uid($uid);
        $customer = $note->customer;
        $histories = $note->histories;

        return view('commercials.views.statements.statements.view')->with([
            'note' => $note,
            'customer' => $customer,
            'histories' => $histories,
        ]);

    }

    public function status(Request $request,$uid){

        $note = Note::uid($uid);
        $types = StatementAnnotationType::available()->get();

        if (!$note->statement) {
            $statement = new Statement();
            $statement->number = Statement::getNextNumber();
            $statement->reference = Statement::getNextNumber();
            $statement->status_id = 1;
            $statement->commercial_id = auth()->id();
            $statement->note_id = $note->id;
            $statement->save();
        } else {
            $statement = $note->statement;
        }

        return view('commercials.views.statements.statements.status')->with([
            'note' => $note,
            'types' => $types,
            'statement' => $statement,
        ]);

    }

    public function arrange($uid){

        $statement = Statement::uid($uid);
        $status = StatementStatuse::slug("venta");

        if ($statement->status_id !== $status->id) {
            $statement->status_id = $status->id;
            $statement->update();
        }

        $note = $statement->note;
        $customer = $note->customer;
        $histories = $note->histories;
        $annotations = $statement->annotations;

        $status = StatementStatuse::available()->whereIn('id', [3, 4, 5])->get();

        return view('commercials.views.statements.statements.arrange')->with([
            'statement' => $statement,
            'note' => $note,
            'customer' => $customer,
            'histories' => $histories,
            'annotations' => $annotations,
            'status' => $status,
        ]);

    }

    public function create()
    {
        $postalcodes = Postalcode::get()->prepend('', '')->pluck('code', 'id');
        $status = NoteStatuses::get()->prepend('', '')->pluck('title', 'id');

        return view('commercials.views.statements.statements.create')->with([
            'postalcodes' => $postalcodes,
            '$status' => $status,
        ]);

    }

    public function store(Request $request)
    {

        $teleoperator = app('teleoperator');

        $customer = new Customer;
        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname = Str::upper($request->lastname);
        $customer->email = $request->email;
        $customer->identification = $request->identification;
        $customer->cellphone = $request->cellphone;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->secondaddress = $request->secondaddress;
        $customer->parish = $request->parish;
        $customer->comments = $request->comments;
        $customer->postalcode_id = ($request->status != 3 && $request->postalcode) ? $request->postalcode : null;
        $customer->null = ($request->status != 3) ? 0 : 1;
        $customer->save();

        $note = new Note;
        $note->number = Note::getNextNumber();
        $note->teleoperator_id = $teleoperator->id;
        $note->customer_id = $customer->id;
        $note->notes = $request->notes;
        $note->status_id = $request->status;
        $note->parish = $request->parish;
        $note->postalcode_id = ($request->status != 3 && $request->postalcode) ? $request->postalcode : null;
        if ($request->status == 1) {
            $note->schedule_id = $request->schedule;
            $note->visit_at = $request->visit;
        }
        $note->save();

        $historie = new NoteHistorie;
        $historie->note_id = $note->id;
        $historie->customer_id = $customer->id;
        $historie->employee_id = $teleoperator->id;
        $historie->status_id = $request->status;
        $historie->call_at = now();

        if ($request->status == 2) {
            $historie->next_call_at = $request->next_call;
            $historie->notes = $request->notes;
        }

        $historie->save();

        return response()->json([
            'success' => true,
            'uid' => $note->uid,
            'message' => 'Cliente y nota creados correctamente.',
        ]);

    }

    public function update(Request $request)
    {
        $teleoperator = app('teleoperator');
        $note = Note::uid($request->uid);
        $customer = $note->customer;

        $last = NoteHistorie::lastByNote($note->id)->first();

        $customer->firstname = Str::upper($request->firstname);
        $customer->lastname = Str::upper($request->lastname);
        $customer->email = $request->email;
        $customer->identification = $request->identification;
        $customer->cellphone = $request->cellphone;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->secondaddress = $request->secondaddress;
        $customer->parish = $request->parish;
        $customer->comments = $request->comments;
        $customer->postalcode_id = ($request->status != 3 && $request->postalcode) ? $request->postalcode : null;
        $customer->null = ($request->status != 3) ? 0 : 1;
        $customer->update();

        $note->notes = $request->notes;
        $note->status_id = $request->status;
        $note->parish = $request->parish;
        $note->postalcode_id = ($request->status != 3 && $request->postalcode) ? $request->postalcode : null;
        if ($request->status == 1) {
            $note->schedule_id = $request->schedule;
            $note->visit_at = $request->visit;
        }
        $note->update();

        $statusChanged = !$last || $last->status_id != $request->status;
        $nextCallChanged = $request->status == 2 && (!$last || $last->next_call_at != $request->next_call);
        $notesChanged = $request->status == 2 && (!$last || $last->notes != $request->notes);
        $scheduleChanged = $request->status == 1 && (!$last || $request->schedule_id != $note->schedule_id || $request->visit_at != $note->visit_at);


        if ($statusChanged || $nextCallChanged || $notesChanged || $scheduleChanged) {

            $historie = new NoteHistorie;
            $historie->note_id = $note->id;
            $historie->customer_id = $customer->id;
            $historie->employee_id = $teleoperator->id;
            $historie->status_id = $request->status;
            $historie->call_at = now();

            if ($request->status == 2) {
                $historie->next_call_at = $request->next_call;
                $historie->notes = $request->notes;
            }

            $historie->save();
        }

        return response()->json([
            'success' => true,
            'uid' => $note->uid,
            'message' => 'Cliente y nota actualizados correctamente.',
        ]);
    }

    public function destroy($uid){
        $note = Product::uid($uid);
        $note->delete();
        return redirect()->route('manager.products');
    }

    public function validateByPhone(Request $request){

        $cellphone = $request->get('cellphone');

        $customer = Customer::where('cellphone', $cellphone)->first();

        if ($customer) {

            if ($customer->null === 1) {
                return response()->json([
                    'success' => false,
                    'exists' => true,
                    'blocked' => true,
                    'message' => 'Este número no desea recibir información y no se puede generar una nota.'
                ]);
            }

            return response()->json([
                'success' => true,
                'exists' => true,
                'uid' => $customer->uid
            ]);
        }

        return response()->json([
            'success' => false,
            'exists' => false
        ]);
    }


    public function generate($uid)
    {
        $statement = Statement::uid($uid);
        $note = $statement->note;
        $customer = $statement->note->customer;

        $accessories = StatementAccessorie::get()->prepend('', '')->pluck('title', 'id');
        $creams = StatementCream::get()->prepend('', '')->pluck('title', 'id');
        $employments = StatementEmployment::get()->prepend('', '')->pluck('title', 'id');
        $housings = StatementHousing::get()->prepend('', '')->pluck('title', 'id');
        $maritals = StatementMarital::get()->prepend('', '')->pluck('title', 'id');
        $methods = StatementMethod::get()->prepend('', '')->pluck('title', 'id');
        $modalities = StatementModalitie::get()->prepend('', '')->pluck('title', 'id');
        $payments = StatementPayment::get()->prepend('', '')->pluck('title', 'id');
        $relationships = StatementRelationship::get()->prepend('', '')->pluck('title', 'id');
        $status = StatementStatuse::get()->prepend('', '')->pluck('title', 'id');
        $schedules = StatementSchedule::get()->prepend('', '')->pluck('title', 'id');

        $bundles = Bundle::available()->pluck('title', 'id')->prepend('', '');

        return view('commercials.views.statements.statements.generate')->with([
            'bundles' => $bundles,
            'statement' => $statement,
            'note' => $note,
            'customer' => $customer,
            'status' => $status,
            'payments' => $payments,
            'schedules' => $schedules,
            'relationships' => $relationships,
            'modalities' => $modalities,
            'methods' => $methods,
            'maritals' => $maritals,
            'employments' => $employments,
            'housings' => $housings,
            'accessories' => $accessories,
            'creams' => $creams,
            'cellphone' => $uid,
        ]);


    }
    public function reschedule($uid)
    {
        $note = Note::uid($uid);
        $customer = $note->customer;
        $status = NoteStatuses::get()->prepend('', '')->pluck('title', 'id');
        $schedules = NoteSchedule::get()->prepend('', '')->pluck('title', 'id');

        return view('commercials.views.statements.statements.reschedule')->with([
            'status' => $status,
            'schedules' => $schedules,
            'note' => $note,
            'customer' => $customer,
        ]);

    }

    public function statuses(Request $request)
    {
        $statement = Statement::uid($request->statement);
        $status = StatementStatuse::slug($request->slug);
        $statement->status_id = $status->id;
        $statement->update();

        return response()->json([
            'success' => true,
            'message' => sprintf("Se ha actualizado el estado de la visita '%s'.", strtoupper($status->title))

        ]);
    }

    public function annotation(Request $request)
    {

        $statement = Statement::uid($request->statement);
        $note = $statement->note;
        $latitude = null;
        $longitude = null;
        $observations = null;

        $status = StatementAnnotationType::slug($request->slug);

        if ($status->slug === 'gps') {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $observations = "{$latitude}, {$longitude}";

            $note->gps = 1;
            $note->gps_latitude = $latitude;
            $note->gps_longitude = $longitude;
            $note->update();

        }

        StatementAnnotation::create([
            'note_id' => $note->id,
            'statement_id' => $statement->id,
            'type_id' => $status->id,
            'commercial_id' => auth()->id(),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'issue' => $status->title,
            'observations' => $observations,
        ]);

        return response()->json([
            'success' => true,
            'message' => sprintf("Se ha generado la anotación '%s'.", strtoupper($status->title))

        ]);
    }


    public function loadBundle($id)
    {
        $bundle = Bundle::with('categories.products')->findOrFail($id);
        return view('commercials.partials.bundle', compact('bundle'));
    }



}
