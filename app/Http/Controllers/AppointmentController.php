<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Carbon\{Carbon, CarbonInterval};
use App\{
    User,
    Patient,
    Appointment,
    Setting,
    Booking,
    Doctor,
    Schedule
};
use Redirect;
use Nexmo;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

        $patients = User::where('role', 'patient')->get();
        $doctors = User::where('role', 'doctor')->get();
        return view('appointment.create', ['patients' => $patients, 'doctors' => $doctors]);
    }

    public function checkslots(Request $request)
    {

        // return $this->getTimeSlot($request->input('date'));

        //Get all the slots of this day
        $date = Carbon::parse($request->input('date'));

        $doctor = User::find($request->input('doctor'))->doctor;

        $availableDays =  json_decode($doctor->available_on);
        $dayIndex = array_search($date->format("l"), $availableDays);

        if ($dayIndex >= 0) {
            $perPatientTime = $doctor->per_patient_time;
            $startShift = json_decode($doctor->available_from)[$dayIndex];
            $endShift = json_decode($doctor->available_to)[$dayIndex];
            $intervals = CarbonInterval::minutes($perPatientTime)->toPeriod($startShift, $endShift);
            $send_slots = [];
            foreach ($intervals as $key => $intervaldate) {
                if ($key < count($intervals) - 1)
                array_push($send_slots, $intervaldate->format('h:i A') . ' - ' . $intervaldate->addMinutes($perPatientTime)->format('h:i A'));
            }
            // Get all pre booking of doctor of date
            $preBooked = Booking::whereDate('date', $request->input('date'))->where('doctor_id', $request->input('doctor'))->get();
            foreach ($preBooked as $key => $time) {
                $bookTime = Carbon::parse($time->date);
                if (($index = array_search($bookTime->format('h:i A') . ' - ' . $bookTime->addMinutes($perPatientTime)->format('h:i A'), $send_slots)) !== false) {
                    unset($send_slots[$index]);
                }
            }
            $final_slots = [];
            foreach ($send_slots as $key => $time) {
                $booktiming = explode("-", $time);
                array_push($final_slots, ['start' => trim($booktiming[0]), 'end' => trim($booktiming[1])]);
            }


            return response()->json(['status' => true, 'final_slots' => $final_slots]);
        } else {
            return response()->json(['status' => false, 'message' => 'Doctor is not available on this date']);
        }


        // $booking = Booking::where('doctor_id',$request->input('doctor'))->whereDate('date',$request->input('date'))->get();
        // $alreadybook = [];
        // foreach($booking as $book){
        //     dump(Carbon::parse($book->date)->format('h:i A l'));
        //    array_push($alreadybook,$book);
        // }
        // die;
    }


    public function available_slot($date, $start, $end)
    {
        $check = Appointment::where('date', $date)->where('time_start', $start)->where('time_end', $end)->where('visited', '!=', '2')->count();
        if ($check == 0) {
            return 'available';
        } else {
            return 'unavailable';
        }
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient' => ['required', 'exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],

        ]);

        $appointment = new Booking();
        $appointment->patient_id = $request->patient;
        $appointment->reason = $request->reason;
        $appointment->doctor_id = $request->doctor;
        $appointment->date = Carbon::parse($request->rdv_time_date . ' ' . $request->rdv_time_start);
        // $appointment->reason = $request->reason;
        $appointment->save();


        // if ($request->send_sms == 1) {

        //     $user = User::findOrFail($request->patient);
        //     $phone = $user->Patient->phone;

        //     Nexmo::message()->send([
        //         'to'   => $phone,
        //         'from' => '213794616181',
        //         'text' => 'You have an appointment on ' . $request->rdv_time_date . ' at ' . $request->rdv_time_start . ' at Doctorino'
        //     ]);
        // }

        return Redirect::route('appointment.all')->with('success', 'Appointment Created Successfully!');
    }

    public function store_edit(Request $request)
    {

        $validatedData = $request->validate([
            'rdv_id' => ['required', 'exists:bookings,id'],
            'rdv_status' => ['required', 'numeric'],
        ]);

        $appointment = Booking::findOrFail($request->rdv_id);
        $appointment->status = $request->rdv_status;
        $appointment->save();

        return Redirect::back()->with('success', 'Appointment Updated Successfully!');
    }

    public function all()
    {
        $appointments = Booking::orderBy('id', 'DESC')->where()->paginate(10);
        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function calendar()
    {

        $appointments = Appointment::orderBy('id', 'DESC')->paginate(10);
        return view('appointment.calendar', ['appointments' => $appointments]);
    }

    public function pending()
    {

        $appointments = Appointment::where('date', '>', Now())->orderBy('id', 'DESC')->paginate(10);
        return view('appointment.pending', ['appointments' => $appointments]);
    }


    public function destroy($id)
    {

        Appointment::destroy($id);
        return Redirect::route('appointment.all')->with('success', 'Appointment Deleted Successfully!');
    }
}
