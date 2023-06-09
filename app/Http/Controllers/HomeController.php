<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Prescription;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App;
use App\Booking;
use App\Drug;
use Auth;
use App\RequestFurniture;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        //$user->assignRole('admin');
        //$user->syncRoles(['assistant']);

        //$role = Role::create(['name' => 'admin']);
        //1$role = Role::create(['name' => 'assistant']);

        //$role = Role::findById(4); $role->givePermissionTo(Permission::all());

        //$permission = Permission::create(['name' => 'manage roles']);

        /*

$permission = Permission::create(['name' => 'view patient']);
$permission = Permission::create(['name' => 'view all patients']);
$permission = Permission::create(['name' => 'delete patient']);

$permission = Permission::create(['name' => 'create health history']);
$permission = Permission::create(['name' => 'delete health history']);

$permission = Permission::create(['name' => 'add medical files']);
$permission = Permission::create(['name' => 'delete medical files']);


$permission = Permission::create(['name' => 'create appointment']);
$permission = Permission::create(['name' => 'view all appointments']);
$permission = Permission::create(['name' => 'delete appointment']);

$permission = Permission::create(['name' => 'create prescription']);
$permission = Permission::create(['name' => 'view prescription']);
$permission = Permission::create(['name' => 'view all prescriptions']);
$permission = Permission::create(['name' => 'edit prescription']);
$permission = Permission::create(['name' => 'delete prescription']);
$permission = Permission::create(['name' => 'print prescription']);


$permission = Permission::create(['name' => 'create drug']);
$permission = Permission::create(['name' => 'edit drug']);
$permission = Permission::create(['name' => 'view drug']);
$permission = Permission::create(['name' => 'view all drugs']);

$permission = Permission::create(['name' => 'create diagnostic test']);
$permission = Permission::create(['name' => 'edit diagnostic test']);
$permission = Permission::create(['name' => 'view all diagnostic tests']);

$permission = Permission::create(['name' => 'create invoice']);
$permission = Permission::create(['name' => 'edit invoice']);
$permission = Permission::create(['name' => 'view invoice']);
$permission = Permission::create(['name' => 'view all invoices']);
$permission = Permission::create(['name' => 'delete invoice']);

    */
        $total_patients = null;
        $total_prescriptions = null;
        $total_patients_today = null;
        $total_appointments = null;
        $total_appointments_today = null;
        $approvedreq = null;

        $request = null;
        $drugs = null;
        $total_payments = null;
        $total_payments_month = null;
        $total_payments_year = null;
        if (Auth::user()->role == 'admin') {
            $total_appointments = Booking::all()->count();
            $total_appointments_today = Booking::wheredate('date', Today())->get();
            $total_prescriptions = Prescription::all()->count();
            $total_patients = User::where('role', 'patient')->count();
            $total_patients_today = User::where('role', 'patient')->wheredate('created_at', Today())->count();
        } else if (Auth::user()->role == "doctor") {
            $total_appointments = Booking::where('doctor_id', Auth::user()->id)->count();
            $total_prescriptions = Prescription::where('doctor_id',Auth::user()->id)->count();
            $total_appointments_today = Booking::wheredate('date', Today())->where('doctor_id', Auth::user()->id)->get();
        } else if (Auth::user()->role == "patient") {
            $total_appointments = Booking::where('patient_id', Auth::user()->id)->count();
            $total_prescriptions = Prescription::where('patient_id',Auth::user()->id)->count();

            $total_appointments_today = Booking::wheredate('date', Today())->where('patient_id', Auth::user()->id)->get();
        } else if (Auth::user()->role == "Pharmist") {
            $total_prescriptions = Prescription::all()->count();
            $drugs = Drug::all()->count();
        }
        else if (Auth::user()->role == "Supervisor") {
            $request = RequestFurniture::all()->count();
            $approvedreq = RequestFurniture::where('approved',1)->count();
            $drugs = Drug::all()->count();
        }

        $total_payments = Billing::all()->count();
        $total_payments = Billing::all()->count();
        $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_month = Billing_item::whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_year = Billing_item::whereYear('created_at', date('Y'))->sum('invoice_amount');


        return view('home', [
            'total_patients' => $total_patients,
            'total_prescriptions' => $total_prescriptions,
            'total_patients_today' => $total_patients_today,
            'total_appointments' => $total_appointments,
            'drugs' => $drugs,
            'request' => $request,
            'approvedreq' => $approvedreq,

            'total_appointments_today' => $total_appointments_today,
            'total_payments' => $total_payments,
            'total_payments_month' => $total_payments_month,
            'total_payments_year' => $total_payments_year
        ]);
    }


    public function lang($locale)
    {

        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
