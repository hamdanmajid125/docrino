@extends('layouts.master')

@section('title')
    {{ $patient->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            @empty(!$patient->image)
                                <center><img src="{{ asset('uploads/' . $patient->image) }}"
                                        class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                            @else
                                <center><img src="{{ asset('img/patient-icon.png') }}"
                                        class="img-profile rounded-circle img-fluid" width="256" height="256"></center>
                            @endempty
                            <h4 class="text-center mt-3"><b>{{ $patient->name }}</b> <label
                                    class="badge badge-primary-soft"> <a href="{{ url('patient/edit/' . $patient->id) }}"><i
                                            class="fa fa-pen"></i></a></label></h4>
                            <hr>



                            @isset($patient->Patient->birthday)
                                <p><b>{{ __('sentence.Birthday') }} :</b> {{ $patient->Patient->birthday }}
                                    ({{ \Carbon\Carbon::parse($patient->Patient->birthday)->age }} Years)</p>
                            @endisset

                            @isset($patient->Patient->gender)
                                <p><b>{{ __('sentence.Gender') }} :</b> {{ __('sentence.' . $patient->Patient->gender) }}</p>
                            @endisset

                            @isset($patient->Patient->phone)
                                <p><b>{{ __('sentence.Phone') }} :</b> {{ $patient->Patient->phone }}</p>
                            @endisset

                            @isset($patient->Patient->adress)
                                <p><b>{{ __('sentence.Address') }} :</b> {{ $patient->Patient->adress }}</p>
                            @endisset
                            @isset($patient->Patient->weight)
                                <p><b>{{ __('sentence.Weight') }} :</b> {{ $patient->Patient->weight }} Kg</p>
                            @endisset

                            @isset($patient->Patient->height)
                                <p><b>{{ __('sentence.Height') }} :</b> {{ $patient->Patient->height }} cm</p>
                            @endisset

                            @isset($patient->Patient->blood)
                                <p><b>{{ __('sentence.Blood Group') }} :</b> {{ $patient->Patient->blood }}</p>
                            @endisset
                            @hasanyrole('patient|Admin')
                                <p><b>Patient Card:</b> <a target="_blank"
                                        href="{{ route('generatecard', $patient->Patient->id) }}">View</a></p>

                            @endrole
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab" aria-controls="Profile"
                                        aria-selected="true">{{ __('sentence.Health History') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                        role="tab" aria-controls="documents" aria-selected="false">Medical Files</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements"
                                        role="tab" aria-controls="appointements"
                                        aria-selected="false">{{ __('sentence.Appointments') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="card-tab" data-toggle="tab" href="#card" role="tab"
                                        aria-controls="card" aria-selected="false">{{ __('Patient Card') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                        role="tab" aria-controls="prescriptions"
                                        aria-selected="false">{{ __('sentence.Prescriptions') }}</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab"
                                        aria-controls="Billing"
                                        aria-selected="false">{{ __('sentence.Payment History') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">

                                    <div class="row">
                                        <div class="col">
                                            @can('create health history')
                                                <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    data-toggle="modal" data-target="#MedicalHistoryModel"><i
                                                        class="fa fa-plus"></i> Add New</button>
                                            @endcan
                                        </div>
                                    </div>

                                    @forelse($historys as $history)
                                        <div class="alert alert-danger">
                                            <p class="text-danger font-size-12">
                                                {!! clean($history->title) !!} - {{ $history->created_at }}
                                                @can('delete health history')
                                                    <span class="float-right"><i class="fa fa-trash" data-toggle="modal"
                                                            data-target="#DeleteModal"
                                                            data-link="{{ url('history/delete/' . $history->id) }}"></i></span>
                                                @endcan
                                            </p>
                                            {!! clean($history->note) !!}
                                        </div>
                                    @empty
                                        <center><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b
                                                class="text-muted">No health history was found</b></center>
                                    @endforelse





                                </div>
                                <div class="tab-pane fade" id="appointements" role="tabpanel"
                                    aria-labelledby="appointements-tab">
                                    <div class="row">
                                        <div class="col">
                                            @can('create appointment')
                                                <a type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                    href="{{ route('appointment.create') }}"><i class="fa fa-plus"></i>
                                                    {{ __('sentence.New Appointment') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th>{{ __('sentence.Patient Name') }}</th>
                                                        <th class="text-center">{{ __('sentence.Reason for visit') }}</th>
                                                        <th class="text-center">{{ __('sentence.Schedule Info') }}</th>
                                                        <th class="text-center">{{ __('sentence.Status') }}</th>
                                                        <th class="text-center">{{ __('sentence.Created at') }}</th>
                                                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($appointments as $appointment)
                                                        <tr>
                                                            <td class="text-center">{{ $appointment->id }}</td>

                                                            <td><a href="{{ url('patient/view/' . $appointment->patient->id) }}">
                                                                    {{ $appointment->patient->name }} </a></td>
                                                            <td class="text-center"><label
                                                                    class="badge badge-primary-soft">{{ $appointment->reason }}</label></td>

                                                            <td class="text-center">
                                                                <label class="badge badge-primary-soft">
                                                                    <i class="fas fa-calendar"></i>
                                                                    {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}
                                                                </label>
                                                                <label class="badge badge-primary-soft">
                                                                    <i class="fa fa-clock"></i>
                                                                    {{ \Carbon\Carbon::parse($appointment->date)->format('h:i A') }} -
                                                                    {{ \Carbon\Carbon::parse($appointment->date)->addMinutes($appointment->doctor->doctor->per_patient_time)->format('h:i A') }}
                                                                </label>
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($appointment->status == false)
                                                                    <label class="badge badge-warning-soft">
                                                                        <i class="fas fa-hourglass-start"></i> {{ __('Not Yet Visited') }}
                                                                    </label>
                                                                @elseif($appointment->status == 2)
                                                                    <label class="badge badge-danger-soft">
                                                                        <i class="fas fa-times"></i> {{ __('Canceled') }}
                                                                    </label>
                                                                @else
                                                                    <label class="badge badge-success-soft">
                                                                        <i class="fas fa-check"></i> {{ __('Confirmed') }}
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td>
                                                            <td align="center">
                                                                @php
                                                                    $date = Carbon\Carbon::parse($appointment->date);
                                                                @endphp

                                                                @can('edit appointment')
                                                                    <a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $date->format('d M Y') }}"
                                                                        data-rdv_time_start="{{ $date->format('h:i A') }}"
                                                                        data-rdv_time_end="{{ $date->addMinutes($appointment->doctor->per_patient_time)->format('h:i A') }}"
                                                                        data-patient_name="{{ $appointment->patient->name }}"
                                                                        class="btn btn-outline-success btn-circle btn-sm" data-toggle="modal"
                                                                        data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                                                                @endcan
                                                                @can('delete appointment')
                                                                    <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                                                        data-target="#DeleteModal"
                                                                        data-link="{{ url('appointment/delete/' . $appointment->id) }}"><i
                                                                            class="fas fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                                                    class="text-muted">You have no appointment</b></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                            <span class="float-right mt-3">{{ $appointments->links() }}</span>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="patient-card">
                                                    <div class="custom-card">
                                                        <div class="img-bx">
                                                            <img src="{{ $patient->image ? asset('uploads/' . $patient->image) : asset('img/patient-icon.png') }}"
                                                                alt="img" />
                                                        </div>
                                                        <div class="content">
                                                            <div class="detail">
                                                                <h2>{{ ucwords($patient->name) }}<br /><span>{{ $patient->gender }}</span></h2>
                                                        <hr>

                                                                <ul class="sci">
                                                                    <li>
                                                                        <p><b>{{ __('sentence.Birthday') }} :</b>
                                                                            {{ $patient->birthday }}
                                                                            ({{ \Carbon\Carbon::parse($patient->birthday)->age }}
                                                                            Years)</p>
                                                                    </li>
                                                                    <li>
                                                                        <p><b>{{ __('Phone') }} :</b>
                                                                            {{ __( $patient->phone) }}</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                        aria-labelledby="prescriptions-tab">
                                        <div class="row">
                                            <div class="col">
                                                @can('create prescription')
                                                    <a class="btn btn-primary btn-sm my-4 float-right"
                                                        href="{{ route('prescription.create') }}"><i class="fa fa-pen"></i>
                                                        {{ __('sentence.Write New Prescription') }}</a>
                                                @endcan
                                            </div>
                                        </div>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                               <tr>
                                                  <th>ID</th>
                                                  <th>{{ __('sentence.Patient') }}</th>
                                                  <th class="text-center">{{ __('sentence.Created') }}</th>
                                                  <th class="text-center">{{ __('sentence.Content') }}</th>
                                                  <th class="text-center">{{ __('sentence.Actions') }}</th>
                                               </tr>
                                            </thead>
                                            <tbody>
                                               @forelse($prescriptions as $prescription)
                                               <tr>
                                                  <td>{{ $prescription->id }}</td>
                                                  <td><a href="{{ url('patient/view/'.$prescription->user_id) }}"> {{ $prescription->User->name }} </a></td>
                                                  <td class="text-center">{{ $prescription->created_at->format('d M Y H:i') }}</td>
                                                  <td class="text-center">
                                                     <label class="badge badge-primary-soft">
                                                        {{ count($prescription->Drug) }} Drugs
                                                     </label>
                                                     <label class="badge badge-primary-soft">
                                                        {{ count($prescription->Test) }} Tests
                                                     </label>
                                                  </td>
                                                  <td class="text-center">
                                                     <a href="{{ url('prescription/view/'.$prescription->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                                     <a href="{{ url('prescription/edit/'.$prescription->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ url('prescription/delete/'.$prescription->id) }}"><i class="fas fa-trash"></i></a>
                                                  </td>
                                               </tr>
                                               @empty
                                               <tr>
                                                  <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b class="text-muted">No prescriptions found</b></td>
                                               </tr>
                                               @endforelse
                                            </tbody>
                                         </table>
                                    </div>

                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        <div class="row">
                                            <div class="col">
                                                @can('edit patient')
                                                    <button type="button" class="btn btn-primary btn-sm my-4 float-right"
                                                        data-toggle="modal" data-target="#NewDocumentModel"><i
                                                            class="fa fa-plus"></i> Add New</button>
                                                @endcan
                                            </div>
                                        </div>

                                        <div class="row">
                                            @forelse($documents as $document)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        @if ($document->document_type == 'pdf')
                                                            <img src="{{ asset('img/pdf.jpg') }}" class="card-img-top">
                                                        @elseif($document->document_type == 'docx')
                                                            <img src="{{ asset('img/docx.png') }}" class="card-img-top">
                                                        @else
                                                            <a class="example-image-link"
                                                                href="{{ url('/uploads/' . $document->file) }}"
                                                                data-lightbox="example-1"><img
                                                                    src="{{ url('/uploads/' . $document->file) }}"
                                                                    class="card-img-top" width="209" height="209"></a>
                                                            <img src="{{ asset('img/pdf.jpg') }}" class="card-img-top">
                                                        @endif
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $document->title }}</h5>
                                                            <p class="font-size-12">{{ $document->note }}</p>
                                                            <p class="font-size-11"><label
                                                                    class="badge badge-primary-soft">{{ $document->created_at }}</label>
                                                            </p>
                                                            <a href="{{ url('/uploads/' . $document->file) }}"
                                                                class="btn btn-primary btn-sm" download><i
                                                                    class="fa fa-cloud-download-alt"></i> Download</a>
                                                            @can('edit patient')
                                                                <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                                    data-target="#DeleteModal"
                                                                    data-link="{{ url('document/delete/' . $document->id) }}"><i
                                                                        class="fa fa-trash"></i></a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col text-center">
                                                    <img src="{{ asset('img/not-found.svg') }}" width="200" /> <br><br> <b
                                                        class="text-muted"> {{ __('sentence.No document available') }} </b>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>


                                    {{-- <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                          <div class="row mt-4">
                            <div class="col-lg-4 mb-4">
                              <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                  {{ __('sentence.Total With Tax') }}
                                  <div class="text-white small">{{ Collect($invoices)->sum('total_with_tax') }} {{ App\Setting::get_option('currency') }}</div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                              <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                  {{ __('sentence.Already Paid') }}
                                  <div class="text-white small">{{ Collect($invoices)->sum('deposited_amount') }} {{ App\Setting::get_option('currency') }}</div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                              <div class="card bg-danger text-white shadow">
                                <div class="card-body">
                                  {{ __('sentence.Due Balance') }}
                                  <div class="text-white small">{{ Collect($invoices)->where('payment_status','Partially Paid')->sum('due_amount') }} {{ App\Setting::get_option('currency') }}</div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              @can('create invoice')
                                <a type="button" class="btn btn-primary btn-sm my-4 float-right" href="{{ route('billing.create') }}"><i class="fa fa-plus"></i> {{ __('sentence.Create Invoice') }}</a>
                              @endcan
                            </div>
                          </div>
                          <table class="table">
                            <tr>
                              <th>{{ __('sentence.Invoice') }}</th>
                              <th>{{ __('sentence.Date') }}</th>
                              <th>{{ __('sentence.Amount') }}</th>
                              <th>{{ __('sentence.Status') }}</th>
                              <th>{{ __('sentence.Actions') }}</th>
                            </tr>
                            @forelse($prescriptions as $invoice)
                            <tr>
                              {{-- <td><a href="{{ url('billing/view/'.$invoice->id) }}">{{ $invoice->reference }}</a></td>
                              <td><label class="badge badge-primary-soft">{{ $invoice->created_at->format('d M Y') }}</label></td>
                              <td> {{ $invoice->total_with_tax }} {{ App\Setting::get_option('currency') }}
                                  @if ($invoice->payment_status == 'Unpaid' or $invoice->payment_status == 'Partially Paid')
                                    <label class="badge badge-danger-soft">{{ $invoice->due_amount }} {{ App\Setting::get_option('currency') }} </label>
                                  @endif
                              </td>
                              <td>
                                @if ($invoice->payment_status == 'Unpaid')
                                <label class="badge badge-danger-soft">
                                    <i class="fas fa-hourglass-start"></i>
                                    {{ __('sentence.Unpaid') }}
                                </label>
                                @elseif($invoice->payment_status == 'Paid')
                                <label class="badge badge-success-soft">
                                    <i class="fas fa-check"></i> {{ __('sentence.Paid') }}
                                </label>
                                @else
                                <label class="badge badge-warning-soft">
                                    <i class="fas fa-user-times"></i>
                                    {{ __('sentence.Partially Paid') }}
                                </label>
                                @endif
                              </td>
                              <td>
                                @can('view invoice')
                                <a href="{{ url('billing/view/'.$invoice->id) }}" class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                @endcan
                                @can('edit invoice')
                                <a href="{{ url('billing/edit/'.$invoice->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                @endcan
                                @can('delete invoice')
                                <a href="{{ url('billing/delete/'.$invoice->id) }}" class="btn btn-outline-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                @endcan
                              </td>
                                    </tr>
                                @empty
                                    <tr>
                                    </tr>
                                    <td colspan="6" align="center"><img src="{{ asset('img/not-found.svg') }}"
                                            width="200" /> <br><br> <b
                                            class="text-muted">{{ __('sentence.No Invoices Available') }}</b></td>
                                    @endforelse
                                    </table>
                                </div>
                            </div>

                        </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Modal-->
                <div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ __('sentence.You are about to modify an appointment') }}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
                                <p><b>{{ __('sentence.Date') }} :</b> <label class="badge badge-primary-soft"
                                        id="rdv_date"></label>
                                </p>
                                <p><b>{{ __('sentence.Time Slot') }} :</b> <label class="badge badge-primary-soft"
                                        id="rdv_time"></span></label>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    data-dismiss="modal">{{ __('sentence.Close') }}</button>
                                <a class="btn btn-primary text-white"
                                    onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
                                <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST"
                                    class="d-none">
                                    <input type="hidden" name="rdv_id" id="rdv_id">
                                    <input type="hidden" name="rdv_status" value="1">
                                    @csrf
                                </form>
                                <a class="btn btn-danger text-white"
                                    onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
                                <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST"
                                    class="d-none">
                                    <input type="hidden" name="rdv_id" id="rdv_id2">
                                    <input type="hidden" name="rdv_status" value="2">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Document Modal -->
                <div id="NewDocumentModel" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add File / Note</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form method="post" action="{{ route('document.store') }}" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="title" placeholder="Title"
                                                required>
                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                            {{ csrf_field() }}
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control-file" name="file"
                                                id="exampleFormControlFile1" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button"
                                        data-dismiss="modal">{{ __('sentence.Close') }}</button>
                                    <button class="btn btn-primary text-white"
                                        type="submit">{{ __('sentence.Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Document Modal -->
            <div id="MedicalHistoryModel" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.New Medical Info') }}</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('history.store') }}" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="title" placeholder="Title"
                                            required>
                                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                        {{ csrf_field() }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <textarea class="form-control" name="note" placeholder="Note" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    data-dismiss="modal">{{ __('sentence.Close') }}</button>
                                <button class="btn btn-primary text-white" type="submit">{{ __('sentence.Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('header')
        <link rel="stylesheet" href="{{ asset('dashboard/css/lightbox.css') }}" />
        <style>
            img.img-profile.rounded-circle.img-fluid {
                height: 250px;
                width: 250px;
            }


            .patient-card {
                display: flex;
                justify-content: center;
                margin-top: 5rem;
            }

            .custom-card {
                box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
                padding: 30px;
                width: 335px;
                height: auto;
                box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 335px;
    background: linear-gradient(90deg, rgba(62,188,253,0.9192051820728291) 25%, rgba(255,255,255,1) 100%);
    height: auto;
            }

            .img-bx {
                display: flex;
                justify-content: center;
                margin-bottom: 2rem;
            }

            .img-bx img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
            }

            .content {
                display: flex;
                justify-content: center;
            }.detail h2 {
    font-weight: 800;
    font-size: 24px;
}

.detail span {
    font-size: 16px;
    font-weight: 600;
    color: #004bad;
}
ul.sci p {
    font-size: 15px;
    text-align: justify;
}

            .detail h2 {
                text-align: center;
                font-size: 27px;
            }

            ul.sci {
                list-style: none;
                padding: 0;
            }
        </style>
    @endsection
    @section('footer')
        <script type="text/javascript" src="{{ asset('dashboard/js/lightbox.js') }}"></script>
    @endsection
