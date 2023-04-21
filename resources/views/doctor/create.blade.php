@extends('layouts.master')
@section('title')
    {{ __('sentence.New Doctor') }}
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Doctor') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ $doctor ? route('doctor.update', $doctor->id) : route('doctor.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="doctor">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                                <input type="text" value="{{ $doctor ? $doctor->name : '' }}" class="form-control"
                                    id="Name" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">{{ __('Email Address') }}<font color="red">*</font>
                                </label>
                                <input type="email" class="form-control" value="{{ $doctor ? $doctor->email : '' }}"
                                    id="Email" name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('sentence.Phone') }}</label>
                                <input type="text" class="form-control" value="{{ $doctor ? $doctor->phone : '' }}"
                                    id="Phone" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('sentence.Birthday') }}<font color="red">*</font></label>
                                <input type="date" class="form-control" value="{{ $doctor ? $doctor->birthday : '' }}"
                                    id="Birthday" name="birthday" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('sentence.Address') }}</label>
                                <input type="text" class="form-control" id="Address"
                                    value="{{ $doctor ? $doctor->address : '' }}" name="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('  Patient per time') }}</label>
                                <input type="text" class="form-control" id="per_patient_time"
                                    value="{{ $doctor ? $doctor->per_patient_time : '' }}" name="per_patient_time">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                                <select class="form-control" name="gender" id="Gender">
                                    <option {{ $doctor ? ($doctor->gender == 'Male' ? 'selected' : '') : '' }}
                                        value="Male">{{ __('sentence.Male') }}</option>
                                    <option {{ $doctor ? ($doctor->gender == 'Female' ? 'selected' : '') : '' }}
                                        value="Female">{{ __('sentence.Female') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip">{{ __('sentence.Blood Group') }}</label>
                                <select class="form-control" name="blood" id="Blood">
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'Unknown' ? 'selected' : '') : '' }}
                                        value="Unknown">{{ __('sentence.Unknown') }}</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'A+' ? 'selected' : '') : '' }}
                                        value="A+">A+</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'A-' ? 'selected' : '') : '' }}
                                        value="A-">A-</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'B+' ? 'selected' : '') : '' }}
                                        value="B+">B+</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'B-' ? 'selected' : '') : '' }}
                                        value="B-">B-</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'O+' ? 'selected' : '') : '' }}
                                        value="O+">O+</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'O-' ? 'selected' : '') : '' }}
                                        value="O-">O-</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'AB+' ? 'selected' : '') : '' }}
                                        value="AB+">AB+</option>
                                    <option
                                        {{ $doctor ? ($doctor->doctor->blood_group == 'AB-' ? 'selected' : '') : '' }}
                                        value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('Weight') }}</label>
                                <input type="text" class="form-control"
                                    value="{{ $doctor ? $doctor->doctor->weight : '' }}" id="Weight" name="weight">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('Height') }}<font color="red">*</font>
                                </label>
                                <input type="text" value="{{ $doctor ? $doctor->doctor->height : '' }}"
                                    class="form-control" id="height" name="height">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="depart">Select Department<font color="red"></font></label>
                                @php
                                    $depart = App\Department::all();
                                @endphp
                                <select name="depart_id" id="depart" class="form-control" required>
                                    @foreach ($depart as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="design">Desigination<font color="red">*</font></label>
                                <input type="text" value="{{ $doctor ? $doctor->doctor->designiation : '' }}"
                                    class="form-control" name="design" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="design">Qualification<font color="red">*</font></label>
                                <input type="text" class="form-control"
                                    value="{{ $doctor ? $doctor->doctor->qualification : '' }}" name="qualification"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="design">Speciality<font color="red">*</font></label>
                                <input type="text" class="form-control"
                                    value="{{ $doctor ? $doctor->doctor->speciality : '' }}" name="speciality"
                                    required>
                            </div>

                        </div>


                        <div class="form-group row">
                            @canany(['edit doctor', 'create doctor'])
                                <button type="submit" class="btn btn-primary mr-2">{{ __('sentence.Save') }}</button>
                                @if ($doctor)
                                <a class="btn btn-info" href="{{ url('schedule/' . $doctor->id . '/edit') }}">Edit Doctor</a>
                            @endif
                            @endcanany



                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('header')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
@endsection
@section('footer')
@endsection
