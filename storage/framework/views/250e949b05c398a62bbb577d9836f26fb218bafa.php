<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit Prescription')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('prescription.update')); ?>">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php
                                $sum = 0;
                                foreach ($prescription->Drug as $value) {
                                    $sum += $value->price;
                                }
                                foreach ($prescription->Test as $key => $value) {
                                    $sum += $value->price;
                                }
                            ?>
                            <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                            <option value="<?php echo e($prescription->user_id); ?>"><?php echo e($prescription->User->name); ?> -
                                <?php echo e(\Carbon\Carbon::parse($prescription->User->Patient->birthday)->age); ?> Years</option>
                            <p>Total Bill: $<span id="totalbill"><?php echo e($sum); ?></span></p>
                            <input type="hidden" name="patient_id" value="<?php echo e($prescription->user_id); ?>">
                            <input type="hidden" name="prescription_id" value="<?php echo e($prescription->id); ?>">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group text-center">
                            <img src="<?php echo e(asset('img/patient-icon.png')); ?>" class="img-profile rounded-circle img-fluid">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?php echo e(__('sentence.Edit Prescription')); ?>"
                                class="btn btn-warning btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Drugs list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable">
                                <?php
                                    $sum = 0;
                                ?>
                                <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription_drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <section class="field-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[trade_name][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value=""><?php echo e(__('Select Drug')); ?>...</option>
                                                    <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($drug->id == $prescription_drug->drug_id): ?>
                                                            <?php
                                                                $sum += $drug->price;
                                                            ?>
                                                        <?php endif; ?>
                                                        <option
                                                            <?php echo e($drug->id == $prescription_drug->drug_id ? 'selected' : ''); ?>

                                                            value="<?php echo e($drug->id); ?>" data-price="<?php echo e($drug->price); ?>">
                                                            <?php echo e($drug->trade_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[drug_type][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value=""><?php echo e(__('Select Drug Type')); ?>...</option>
                                                    <?php $__currentLoopData = $drug_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php echo e($drug->id == $prescription_drug->drug_id ? 'selected' : ''); ?>

                                                            value="<?php echo e($drug->id); ?>"><?php echo e($drug->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <select class="form-control multiselect-drug" name="druginfo[sick_type][]"
                                                    id="drug" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value=""><?php echo e(__('Select Sick Drug Type')); ?>...</option>
                                                    <?php $__currentLoopData = $sick; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php echo e($drug->id == $prescription_drug->sick_type_id ? 'selected' : ''); ?>

                                                            value="<?php echo e($drug->id); ?>"><?php echo e($drug->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="strength" name="druginfo[strength][]"
                                                        value="<?php echo e($prescription_drug->strength); ?>" class="form-control"
                                                        placeholder="Mg/Ml" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="dose" name="druginfo[dose][]"
                                                        class="form-control" value="<?php echo e($prescription_drug->dose); ?>"
                                                        placeholder="<?php echo e(__('sentence.Dose')); ?>" disabled>
                                                    <label class="control-label"></label><i class="bar"></i>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <input type="text" id="duration"
                                                        value="<?php echo e($prescription_drug->duration); ?>"
                                                        name="druginfo[duration][]" class="form-control"
                                                        placeholder="<?php echo e(__('sentence.Duration')); ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group-custom">
                                                    <input type="text" id="drug_advice"
                                                        value="<?php echo e($prescription_drug->drug_advice); ?>"
                                                        name="druginfo[drug_advice][]" class="form-control"
                                                        placeholder="<?php echo e(__('sentence.Advice_Comment')); ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"
                                                    onclick="prescriptionDelete(<?php echo e($prescription_drug->id); ?>,1)"><i
                                                        class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                                            </div>
                                            <div class="col-12">
                                                <hr color="#a1f1d4">
                                            </div>
                                        </div>
                                    </section>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Tests list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable">
                                <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription_test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="field-group row">

                                        <div class="col-md-4">
                                            <select class="form-control multiselect-doctorino" name="test_name[]"
                                                id="test" tabindex="-1" aria-hidden="true" disabled>
                                                <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($test->id == $prescription_test->test_id): ?>
                                                    <?php
                                                        $sum += $test->price;
                                                    ?>
                                                <?php endif; ?>
                                                    <option
                                                        <?php echo e($test->id == $prescription_test->test_id ? 'selected' : ''); ?>

                                                        value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <input type="text" id="strength" name="description[]"
                                                    class="form-control" placeholder="<?php echo e(__('sentence.Description')); ?>">
                                                <input type="hidden" name="prescription_test_id[]"
                                                    value="<?php echo e($prescription_test->description); ?>" disabled>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a onclick="prescriptionDelete(<?php echo e($prescription_test->id); ?>,2)"
                                                type="button" class="btn btn-danger delete text-white btn-sm"
                                                align="center"><i class="fa fa-trash font-size-12"></i>
                                                <?php echo e(__('sentence.Remove')); ?></a>

                                        </div>
                                        <div class="col-12">
                                            <hr color="#a1f1d4">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
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
                _token: "<?php echo e(csrf_token()); ?>",
                url: "<?php echo e(route('deleteprescriptiondrug')); ?>",
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
                     <option value=""><?php echo e(__('Select Drug')); ?>...</option>
                     <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option  value="<?php echo e($drug->id); ?>" data-price="<?php echo e($drug->price); ?>"><?php echo e($drug->trade_name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
              </div>
                <div class="col-md-6">
                     <select class="form-control multiselect-drug" name="druginfo[drug_type][]" id="drug" tabindex="-1" aria-hidden="true" required>
                       <option value=""><?php echo e(__('Select Drug Type')); ?>...</option>
                       <?php $__currentLoopData = $drug_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                </div>
               </div>
               <br>
               <div class="row">

                <div class="col-md-6">
                    <select class="form-control multiselect-drug" name="druginfo[sick_type][]" id="drug" tabindex="-1" aria-hidden="true" required>
                      <option value=""><?php echo e(__('Select Sick Drug Type')); ?>...</option>
                      <?php $__currentLoopData = $sick; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <input type="text" id="dose" name="druginfo[dose][]" class="form-control" placeholder="<?php echo e(__('sentence.Dose')); ?>">
                        <label class="control-label"></label><i class="bar"></i>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <input type="text" id="duration" name="druginfo[duration][]" class="form-control" placeholder="<?php echo e(__('sentence.Duration')); ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group-custom">
                        <input type="text" id="drug_advice" name="druginfo[drug_advice][]" class="form-control" placeholder="<?php echo e(__('sentence.Advice_Comment')); ?>">
                    </div>
                </div>
                 <div class="col-md-3">
                       <a type="button" class="btn btn-danger btn-sm text-white span-2 delete" ><i class="fa fa-times-circle" ></i> <?php echo e(__('sentence.Remove')); ?></a>
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
                  <option value=""><?php echo e(__('sentence.Select Test')); ?>...</option>
                  <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-4">
                <div class="form-group-custom">
                    <input type="text" id="strength" name="test[description][]"  class="form-control" placeholder="<?php echo e(__('sentence.Description')); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Remove')); ?></a>

             </div>
             <div class="col-12">
                   <hr color="#a1f1d4">
             </div>
        </div>
       </section>
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Documents\GitHub\docrino\resources\views/prescription/edit.blade.php ENDPATH**/ ?>