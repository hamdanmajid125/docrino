@extends('layouts.master')
@section('title')
    {{ __('sentence.New Prescription') }}
@endsection

@section('content')
    <form method="post" action="{{ route('prescription.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Patient informations') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID">{{ __('sentence.Patient') }} :</label>
                            <select class="form-control multiselect-doctorino" name="patient_id" id="PatientID" required>
                                <option>{{ __('sentence.Select Patient') }}</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->age }}</option>
                                @endforeach
                            </select>
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group text-center">
                            <img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="{{ __('sentence.Create Prescription') }}"
                                class="btn btn-warning btn-block" align="center">
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
                            <div class="repeatable"></div>
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
                            <div class="repeatable"></div>
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



    <script type="text/template" id="drugs_labels">
   <section class="field-group">
                         <div class="row">
                            <div class="col-md-6">
                                <select class="form-control multiselect-drug" name="druginfo[drug_type][]" id="drugcat" tabindex="-1" aria-hidden="true" required onchange="changeCategory(this)">
                                  <option value="">{{ __('Select Drug Category') }}...</option>
                                  @foreach($drug_type as $drug)
                                      <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                  @endforeach
                                </select>
                           </div>
                            <div class="col-md-6">
                                <select class="form-control multiselect-drug" name="druginfo[trade_name][]" id="drug" tabindex="-1" aria-hidden="true" required>
                                  <option value="">{{ __('Select Drug') }}...</option>

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

@push('js')
    <script>
        function changeCategory(e) {
            let $this =e;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route("getdrug") }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    category: e.value
                },
                success: function(response) {
                    if(response.status){
                        $($(e).parent().next().find('select')[0]).html('')
                        response.drugs.forEach(obj => {
                            console.log()
                            $($(e).parent().next().find('select')[0]).append($('<option>', {
                                value: obj.id,
                                text: obj.trade_name
                            }));


                        });
                    }
                }
            });

        }
    </script>
@endpush
