<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New Doctor')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.New Doctor')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="<?php echo e($doctor ? route('doctor.update', $doctor->id) : route('doctor.store')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="role" value="doctor">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                                <input type="text" value="<?php echo e(($doctor) ? $doctor->name : ''); ?>" class="form-control" id="Name" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"><?php echo e(__('Email Address')); ?><font color="red">*</font>
                                </label>
                                <input type="email" class="form-control" value="<?php echo e(($doctor) ? $doctor->email : ''); ?>" id="Email" name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                                <input type="text" class="form-control" value="<?php echo e(($doctor) ? $doctor->phone : ''); ?>" id="Phone" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                                <input type="date" class="form-control" value="<?php echo e(($doctor) ? $doctor->birthday : ''); ?>" id="Birthday" name="birthday"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                                <input type="text" class="form-control" id="Address" value="<?php echo e(($doctor) ? $doctor->address : ''); ?>" name="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('  Patient per time')); ?></label>
                                <input type="text" class="form-control" id="per_patient_time" value="<?php echo e(($doctor) ? $doctor->per_patient_time : ''); ?>" name="per_patient_time">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                                <select class="form-control" name="gender" id="Gender">
                                    <option <?php echo e(($doctor) ? (($doctor->gender == 'Male') ? 'selected' : '') : ''); ?>  value="Male"><?php echo e(__('sentence.Male')); ?></option>
                                    <option <?php echo e(($doctor) ? (($doctor->gender == 'Female') ? 'selected' : '') : ''); ?>   value="Female"><?php echo e(__('sentence.Female')); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputZip"><?php echo e(__('sentence.Blood Group')); ?></label>
                                <select class="form-control" name="blood" id="Blood">
                                    <option <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'Unknown') ? 'selected' : '') : ''); ?>  value="Unknown"><?php echo e(__('sentence.Unknown')); ?></option>
                                    <option  <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'A+') ? 'selected' : '') : ''); ?> value="A+">A+</option>
                                    <option <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'A-') ? 'selected' : '') : ''); ?>  value="A-">A-</option>
                                    <option <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'B+') ? 'selected' : '') : ''); ?>  value="B+">B+</option>
                                    <option  <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'B-') ? 'selected' : '') : ''); ?> value="B-">B-</option>
                                    <option <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'O+') ? 'selected' : '') : ''); ?>  value="O+">O+</option>
                                    <option  <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'O-') ? 'selected' : '') : ''); ?> value="O-">O-</option>
                                    <option  <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'AB+') ? 'selected' : '') : ''); ?> value="AB+">AB+</option>
                                    <option <?php echo e(($doctor) ? (($doctor->doctor->blood_group == 'AB-') ? 'selected' : '') : ''); ?>  value="AB-">AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('Weight')); ?></label>
                                <input type="text" class="form-control" value="<?php echo e(($doctor) ? $doctor->doctor->weight : ''); ?>" id="Weight" name="weight">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><?php echo e(__('Height')); ?><font color="red">*</font>
                                </label>
                                <input type="text" value="<?php echo e(($doctor) ? $doctor->doctor->height : ''); ?>" class="form-control" id="height" name="height">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="depart">Select Department<font color="red"></font></label>
                                <?php
                                    $depart = App\Department::all();
                                ?>
                                <select name="depart_id" id="depart" class="form-control" required>
                                    <?php $__currentLoopData = $depart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="design">Desigination<font color="red">*</font></label>
                                <input type="text" value="<?php echo e(($doctor) ? $doctor->doctor->designiation : ''); ?>" class="form-control" name="design" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="design">Qualification<font color="red">*</font></label>
                                <input type="text" class="form-control"  value="<?php echo e(($doctor) ? $doctor->doctor->qualification : ''); ?>"  name="qualification" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="design">Speciality<font color="red">*</font></label>
                                <input type="text" class="form-control"  value="<?php echo e(($doctor) ? $doctor->doctor->speciality : ''); ?>"  name="speciality" required>
                            </div>

                        </div>


                        <div class="form-group row">

                            <button type="submit" class="btn btn-primary mr-2"><?php echo e(__('sentence.Save')); ?></button>
                            <?php if($doctor): ?>
                            <a class="btn btn-info" href="<?php echo e(url('schedule/'.$doctor->id.'/edit')); ?>">Edit Doctor</a>

                            <?php endif; ?>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Desktop\practice\FYP - Copy\resources\views/doctor/create.blade.php ENDPATH**/ ?>