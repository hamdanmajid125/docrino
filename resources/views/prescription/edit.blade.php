@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Prescription') }}
@endsection

@section('content')
    <form method="post" action="{{ route('prescription.update') }}">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            @php
                                $sum = 0;
                                foreach ($prescription->Drug as $value) {
                                    $sum += $value->price;
                                }
                                foreach ($prescription->Test as $key => $value) {
                                    $sum += $value->price;
                                }
                            @endphp
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <option value="{{ $prescription->user_id }}">{{ $prescription->User->name }} -
                                {{ \Carbon\Carbon::parse($prescription->User->Patient->birthday)->age }} Years</option>
                            <p>Total Bill: $<span id="totalbill">{{ $sum }}</span></p>
                            <input type="hidden" name="patient_id" value="{{ $prescription->user_id }}">
                            <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group text-center">
                            <img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Edit Prescription') }}"
                                class="btn btn-warning btn-block" align="center">
                        </div>
                        <div class="form-group">
                            <a class="btn btn-success w-100" href="{{ route('generatebill',$prescription->id) }}">Generate Bill</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Drugs list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable">
                                @php
                                    $sum = 0;
                                @endphp
                                @foreach ($prescription_drugs as $prescription_drug)
                                    <section class="field-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[trade_name][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value="">{{ __('Select Drug') }}...</option>
                                                    @foreach ($drugs as $drug)
                                                        @if ($drug->id == $prescription_drug->drug_id)
                                                            @php
                                                                $sum += $drug->price;
                                                            @endphp
                                                        @endif
                                                        <option
                                                            {{ $drug->id == $prescription_drug->drug_id ? 'selected' : '' }}
                                                            value="{{ $drug->id }}" data-price="{{ $drug->price }}">
                                                            {{ $drug->trade_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[drug_type][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value="">{{ __('Select Drug Type') }}...</option>
                                                    @foreach ($drug_type as $drug)
                                                        <option
                                                            {{ $drug->id == $prescription_drug->drug_id ? 'selected' : '' }}
                                                            value="{{ $drug->id }}">{{ $drug->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[sick_type][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value="">{{ __('Select Sick Drug Type') }}...</option>
                                                    @foreach ($sick as $drug)
                                                        <option
                                                            {{ $drug->id == $prescription_drug->sick_type_id ? 'selected' : '' }}
                                                            value="{{ $drug->id }}">{{ $drug->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="strength" name="druginfo[strength][]"
                                                        value="{{ $prescription_drug->strength }}" class="form-control"
                                                        placeholder="Mg/Ml" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="dose" name="druginfo[dose][]"
                                                        class="form-control" value="{{ $prescription_drug->dose }}"
                                                        placeholder="{{ __('sentence.Dose') }}" disabled>
                                                    <label class="control-label"></label><i class="bar"></i>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="duration"
                                                        value="{{ $prescription_drug->duration }}"
                                                        name="druginfo[duration][]" class="form-control"
                                                        placeholder="{{ __('sentence.Duration') }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice"
                                                        value="{{ $prescription_drug->drug_advice }}"
                                                        name="druginfo[drug_advice][]" class="form-control"
                                                        placeholder="{{ __('sentence.Advice_Comment') }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"
                                                    onclick="prescriptionDelete({{ $prescription_drug->id }},1)"><i
                                                        class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
                                            </div>
                                            <div class="col-12">
                                                <hr color="#a1f1d4">
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Drug') }}</a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Tests list') }}</h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable">
                                @foreach ($prescription_tests as $prescription_test)
                                    <div class="field-group row">

                                        <div class="col-md-4">
                                            <select class="form-control multiselect-doctorino" name="test_name[]"
                                                id="test" tabindex="-1" aria-hidden="true" disabled>
                                                @foreach ($tests as $test)
                                                @if ($test->id == $prescription_test->test_id)
                                                    @php
                                                        $sum += $test->price;
                                                    @endphp
                                                @endif
                                                    <option
                                                        {{ $test->id == $prescription_test->test_id ? 'selected' : '' }}
                                                        value="{{ $test->id }}">{{ $test->test_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="description[]"
                                                    class="form-control" placeholder="{{ __('sentence.Description') }}">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="{{ $prescription_test->description }}" disabled>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a onclick="prescriptionDelete({{ $prescription_test->id }},2)"
                                                type="button" class="btn btn-danger delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                {{ __('sentence.Remove') }}</a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> {{ __('sentence.Add Test') }}</a>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        const prescriptionDelete = (id, via) => {
            alert("here")
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('deleteprescriptiondrug') }}",
                type: "post",
                data: {
                    via: via,
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.notify({
                            message: "Drug prescription deleted"
                        }, {
                            type: "success",
                            delay: 5000,
                        });
                    }


                }
            })

        }
        $(document).ready(function() {
            $('.multiselect-doctorino').select2();
        });

        $(document).ready(function() {
            $('.multiselect-drug').select2();
        });
    </script>


    <script type="text/template" id="drugs_labels">
        <section class="field-group">
            <div class="row">
               <div class="col-md-6">
                   <select class="form-control multiselect-drug" name="druginfo[trade_name][]" id="drug" tabindex="-1" aria-hidden="true" required>
                     <option value="">{{ __('Select Drug') }}...</option>
                     @foreach($drugs as $drug)
                         <option  value="{{ $drug->id }}" data-price="{{ $drug->price }}">{{ $drug->trade_name }}</option>
                     @endforeach
                   </select>
              </div>
                <div class="col-md-6">
                     <select class="form-control multiselect-drug" name="druginfo[drug_type][]" id="drug" tabindex="-1" aria-hidden="true" required>
                       <option value="">{{ __('Select Drug Type') }}...</option>
                       @foreach($drug_type as $drug)
                           <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                       @endforeach
                     </select>
                </div>
               </div>
               <br>
               <div class="row">

                <div class="col-md-6">
                    <select class="form-control multiselect-drug" name="druginfo[sick_type][]" id="drug" tabindex="-1" aria-hidden="true" required>
                      <option value="">{{ __('Select Sick Drug Type') }}...</option>
                      @foreach($sick as $drug)
                          <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <input type="text" id="strength" name="druginfo[strength][]"  class="form-control" placeholder="Mg/Ml">
                    </div>
                </div>
            </div>
            <br>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group-custom">
                        <input type="text" id="dose" name="druginfo[dose][]" class="form-control" placeholder="{{ __('sentence.Dose') }}">
                        <label class="control-label"></label><i class="bar"></i>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <input type="text" id="duration" name="druginfo[duration][]" class="form-control" placeholder="{{ __('sentence.Duration') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="druginfo[drug_advice][]" class="form-control" placeholder="{{ __('sentence.Advice_Comment') }}">
                    </div>
                </div>
                 <div class="col-md-3">
                       <a type="button" class="btn btn-danger btn-sm text-white span-2 delete" ><i class="fa fa-times-circle" ></i> {{ __('sentence.Remove') }}</a>
                  </div>
                  <div class="col-12">
                       <hr color="#a1f1d4">
                 </div>
            </div>
    </section>

</script>
    <script type="text/template" id="test_labels">
        <section class="field-group row">

            <div class="col-md-4">
                <select class="form-control multiselect-doctorino" name="test[test_name][]" id="test" tabindex="-1" aria-hidden="true" required>
                  <option value="">{{ __('sentence.Select Test') }}...</option>
                  @foreach($tests as $test)
                      <option value="{{ $test->id }}">{{ $test->test_name }}</option>
                  @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="test[description][]"  class="form-control" placeholder="{{ __('sentence.Description') }}">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"><i class='fa fa-plus'></i> {{ __('sentence.Remove') }}</a>

             </div>
             <div class="col-12">
                   <hr color="#a1f1d4">
             </div>
        </div>
       </section>
</script>
@endsection

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
