<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\Patient;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Prescription;
use App\Prescription_drug;
use App\Prescription_test;
use App\Test;
use App\{DrugType, SickType};
use Redirect;
use Arr;
use Auth;


class PrescriptionController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {

        $drugs = Drug::all();
        $patients = User::where('role', 'patient')->get();
        $tests = Test::all();
        $sick = SickType::all();
        $drug_type = DrugType::all();

        return view('prescription.create', ['drugs' => $drugs, 'patients' => $patients, 'tests' => $tests, 'sick' => $sick, 'drug_type' => $drug_type]);
    }

    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'patient_id' => ['required', 'exists:users,id']
        ]);




        $prescription = new Prescription;

        $prescription->user_id = $request->patient_id;
        $prescription->doctor_id = Auth::user()->id;
        $prescription->reference = 'p' . rand(10000, 99999);

        $prescription->save();


        if (isset($request->druginfo)) :

            $i = count($request->druginfo['drug_type']);

            for ($x = 0; $x < $i; $x++) {

                if ($request->druginfo != null) {

                    $add_drug = new Prescription_drug;
                    $add_drug->type = $request->druginfo['drug_type'][$x];
                    $add_drug->sick_type_id = $request->druginfo['sick_type'][$x];
                    $add_drug->strength = $request->druginfo['strength'][$x];
                    $add_drug->dose = $request->druginfo['dose'][$x];
                    $add_drug->duration = $request->druginfo['duration'][$x];
                    $add_drug->drug_advice = $request->druginfo['drug_advice'][$x];
                    $add_drug->prescription_id = $prescription->id;
                    $add_drug->drug_id = $request->druginfo['trade_name'][$x];

                    $add_drug->save();
                }
            }
        endif;

        if (isset($request->test_name)) :

            $y = count($request->test['test_name']);

            for ($x = 0; $x < $y; $x++) {

                $add_test = new Prescription_test;

                $add_test->test_id = $request->test['test_name'][$x];
                $add_test->prescription_id = $prescription->id;
                $add_test->description = $request->test['description'][$x];

                $add_test->save();
            }

        endif;

        return Redirect::route('prescription.all')->with('success', 'Prescription Created Successfully!');
    }

    public function all()
    {

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'receptionist' || Auth::user()->role == 'Pharmist')
            $prescriptions = Prescription::orderBy('id', 'DESC')->paginate(10);
        else
            $prescriptions = Prescription::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);

        return view('prescription.all', ['prescriptions' => $prescriptions]);
    }

    public function view($id)
    {

        $prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();
        $prescription_tests = Prescription_test::where('prescription_id', $id)->get();

        return view('prescription.view', ['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs, 'prescription_tests' => $prescription_tests]);
    }

    public function pdf($id)
    {

        $prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();
        $prescription_tests = Prescription_test::where('prescription_id', $id)->get();

        view()->share(['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs]);
        

        $user = User::find($prescription->user_id);
        $customer = new Buyer([
            'name'          => $user->name,
            'address' => $user->address,
            'phone' => $user->phone,
            'custom_fields' => [
                'email' => $user->email,
                'age' => $user->age,
                'gender' => $user->gender,
            ],
        ]);

        $items = [];
        if (!$prescription_drugs->isEmpty()) {
            foreach ($prescription_drugs as $drug) {
                array_push($items, (new InvoiceItem())->title($drug->Drug->trade_name)->pricePerUnit($drug->Drug->price));
               
            }
        }
        if (!$prescription_tests->isEmpty()) {
            foreach ($prescription_tests as $test) {
                array_push($items, (new InvoiceItem())->title($test->Test->test_name)->pricePerUnit($test->Test->price));
               
            }
        }
        $notes = [
            'Keep yourself healthy'
        ];
        $notes = implode("<br>", $notes);
    

        $invoice = Invoice::make()
            ->buyer($customer)
            ->dateFormat('m/d/Y')
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->addItems($items);

        return $invoice->stream();
    }


    public function edit($id)
    {

        $prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id', $id)->get();
        $prescription_tests = Prescription_test::where('prescription_id', $id)->get();

        $drugs = Drug::all();
        $tests = Test::all();
        $sick = SickType::all();
        $drug_type = DrugType::all();

        return view('prescription.edit', ['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs, 'prescription_tests' => $prescription_tests, 'drugs' => $drugs, 'tests' => $tests, 'sick' => $sick, 'drug_type' => $drug_type]);
    }


    public function deleteprescriptiondrug(Request $request)
    {
        if ($request->input('via') == 1) {
            Prescription_drug::destroy($request->id);
        } else {
            Prescription_test::destroy($request->id);
        }
        return response()->json(['status' => true]);
    }
    public function update(Request $request)
    {
        $prescription = Prescription::findOrfail($request->input('prescription_id'));


        if (isset($request->druginfo)) :

            $i = count($request->druginfo['drug_type']);

            for ($x = 0; $x < $i; $x++) {

                if ($request->druginfo != null) {

                    $add_drug = new Prescription_drug;
                    $add_drug->type = $request->druginfo['drug_type'][$x];
                    $add_drug->sick_type_id = $request->druginfo['sick_type'][$x];
                    $add_drug->strength = $request->druginfo['strength'][$x];
                    $add_drug->dose = $request->druginfo['dose'][$x];
                    $add_drug->duration = $request->druginfo['duration'][$x];
                    $add_drug->drug_advice = $request->druginfo['drug_advice'][$x];
                    $add_drug->prescription_id = $prescription->id;
                    $add_drug->drug_id = $request->druginfo['trade_name'][$x];

                    $add_drug->save();
                }
            }
        endif;

        if (isset($request->test)) :

            $y = count($request->test['test_name']);

            for ($x = 0; $x < $y; $x++) {

                $add_test = new Prescription_test;

                $add_test->test_id = $request->test['test_name'][$x];
                $add_test->prescription_id = $prescription->id;
                $add_test->description = $request->test['description'][$x];

                $add_test->save();
            }

        endif;



        return Redirect::route('prescription.view', ['id' => $request->prescription_id])->with('success', 'Prescription Edited Successfully!');;

        //return $request;

    }


    public function destroy($id)
    {

        Prescription::destroy($id);
        return Redirect::route('prescription.all')->with('success', 'Prescription Deleted Successfully!');;
    }


    public function view_for_user(Request $request, $id)
    {

        $User = User::findOrfail($id);

        $prescriptions = Prescription::where('user_id', $id)->paginate(10);
        return view('prescription.view_for_user', ['prescriptions' => $prescriptions]);
    }
}
