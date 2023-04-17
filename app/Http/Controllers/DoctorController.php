<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\{User, Doctor, Booking};
use Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $users = User::where('role', 'doctor')->paginate(5);
        return view('doctor.all', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name');
        $doctor = null;

        return view('doctor.create', compact('roles', 'doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userRequest = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'doctor',
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'password' => Hash::make('newdoctor123')
        ];
        $user = User::create($userRequest);

        $doctorRequest = [
            'user_id' => $user->id,
            'blood_group' => $request->blood,
            'weight' => $request->weight,
            'height' => $request->height,
            'depart_id' => $request->depart_id,
            'per_patient_time' => $request->per_patient_time,
            'designiation' => $request->design,
            'qualification' => $request->qualification,
            'speciality' => $request->speciality,
        ];
        $doctor = Doctor::create($doctorRequest);
        return redirect('schedule/' . $user->id . '/edit');
    }

    public function appointment_all()
    {
        $appointments = Booking::where('doctor_id', Auth::user()->id)->paginate(10);
        return view('appointment.all', ['appointments' => $appointments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all()->pluck('name');
        $doctor = User::find($id);


        return view('doctor.create', compact('roles', 'doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
