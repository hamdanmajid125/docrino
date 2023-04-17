<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Create Schedule')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class='d-flex flex-column-fluid'>
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <input id="createHospitalSchedule" class="hospitalSchedule" name="hospitalSchedule" type="hidden">

                        <form method="POST" action="<?php echo e(route('schedule.store')); ?>" accept-charset="UTF-8"
                            id="createScheduleForm" class="scheduleForm" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($doctor->id); ?>">
                            <div class="row gx-10 mb-5">
                                <div class="alert alert-danger d-none hide" id="scheduleErrorsBox">
                                </div>
                                <div class="form-group col-sm-8 mb-5">
                                    <label for="doctor_name" class="form-label">Doctor: <?php echo e($doctor->user->name); ?></label>

                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 schedulesCon">
                                    <table class="schedules-table schedules-table-bordered table table-striped">
                                        <thead
                                            class="schedules-table-theme text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <th>Available On: <span class="required"></span></th>
                                            <th>Available From: <span class="required"></span></th>
                                            <th>Available To: <span class="required"></span></th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody class="schedule-container text-gray-600 fw-bold">
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-0"
                                                        readonly name="available_on[]" type="text" value="Monday">
                                                </td>
                                                <?php
                                                    $available_from = json_decode($doctor->available_from);
                                                    $available_to = json_decode($doctor->available_to);
                                                ?>

                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-0"
                                                        class="form-control availableFrom hospitalScheduleFrom-1 bg-white"
                                                        required autocomplete="off" name="available_from[]" type="time"
                                                        value="<?php echo e($available_from ? $available_from[0] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-0"
                                                        class="form-control availableTo hospitalScheduleTo-1 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[0] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn0"
                                                        href="javascript:void(0)" data-id="0">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-1"
                                                        readonly name="available_on[]" type="text" value="Tuesday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-1"
                                                        class="form-control availableFrom hospitalScheduleFrom-2 bg-white"
                                                        required autocomplete="off" name="available_from[]" type="time"
                                                        value="<?php echo e($available_from ? $available_from[1] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-1"
                                                        class="form-control availableTo hospitalScheduleTo-2 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[1] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn1"
                                                        href="javascript:void(0)" data-id="1">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-2"
                                                        readonly name="available_on[]" type="text" value="Wednesday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-2"
                                                        class="form-control availableFrom hospitalScheduleFrom-3 bg-white"
                                                        required autocomplete="off" name="available_from[]" type="time"
                                                        value="<?php echo e($available_from ? $available_from[2] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-2"
                                                        class="form-control availableTo hospitalScheduleTo-3 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[2] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn2"
                                                        href="javascript:void(0)" data-id="2">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-3"
                                                        readonly name="available_on[]" type="text" value="Thursday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-3"
                                                        class="form-control availableFrom hospitalScheduleFrom-4 bg-white"
                                                        required autocomplete="off" name="available_from[]"
                                                        type="time" value="<?php echo e($available_from ? $available_from[3] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-3"
                                                        class="form-control availableTo hospitalScheduleTo-4 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[3] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn3"
                                                        href="javascript:void(0)" data-id="3">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-4"
                                                        readonly name="available_on[]" type="text" value="Friday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-4"
                                                        class="form-control availableFrom hospitalScheduleFrom-5 bg-white"
                                                        required autocomplete="off" name="available_from[]"
                                                        type="time" value="<?php echo e($available_from ? $available_from[4] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-4"
                                                        class="form-control availableTo hospitalScheduleTo-5 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[4] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn4"
                                                        href="javascript:void(0)" data-id="4">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-5"
                                                        readonly name="available_on[]" type="text" value="Saturday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-5"
                                                        class="form-control availableFrom hospitalScheduleFrom-6 bg-white"
                                                        required autocomplete="off" name="available_from[]"
                                                        type="time" value="<?php echo e($available_from ? $available_from[5] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-5"
                                                        class="form-control availableTo hospitalScheduleTo-6 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_to ? $available_to[5] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn5"
                                                        href="javascript:void(0)" data-id="5">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="schedules-table-td">
                                                    <input class="form-control availableOn" required id="availableOn-6"
                                                        readonly name="available_on[]" type="text" value="Sunday">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableFrom-6"
                                                        class="form-control availableFrom hospitalScheduleFrom-7 bg-white"
                                                        required autocomplete="off" name="available_from[]"
                                                        type="time" value="<?php echo e($available_from ? $available_from[6] : '00:00:00'); ?>">
                                                </td>
                                                <td class="schedules-table-td position-relative">
                                                    <input id="availableTo-6"
                                                        class="form-control availableTo hospitalScheduleTo-7 bg-white"
                                                        required autocomplete="off" name="available_to[]" type="time"
                                                        value="<?php echo e($available_from ? $available_to[6] : '00:00:00'); ?>">
                                                </td>
                                                <td class="text-center schedules-table-td">

                                                    <a title="copy-previous"
                                                        class="btn action-btn btn-primary btn-sm copy-btn cpy-btn6"
                                                        href="javascript:void(0)" data-id="6">
                                                        <i class="fa fa-copy action-icon"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input class="btn btn-primary me-2" id="scheduleSave" type="submit" value="Save">
                                <a href="https://hms.infyom.com/schedules" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HAMDAN\Desktop\custom-backend\FYP - Copy\FYP - Copy\resources\views/schedule/edit.blade.php ENDPATH**/ ?>