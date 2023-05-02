<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Prescriptions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Prescriptions')); ?></h6>
                </div>
                <div class="col-4">
                    <a href="<?php echo e(route('prescription.create')); ?>" class="btn btn-primary btn-sm float-right"><i
                            class="fa fa-plus"></i> <?php echo e(__('sentence.New Prescription')); ?></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo e(__('sentence.Patient')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Created')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Content')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                            <th class="text-center"><?php echo e(__('Status')); ?></th>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('issue prescription')): ?>
                                <th class="text-center"><?php echo e(__('Issue Prescription')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($prescription->id); ?></td>
                                <td><a href="<?php echo e(url('patient/view/' . $prescription->user_id)); ?>">
                                        <?php echo e($prescription->User->name); ?> </a></td>
                                <td class="text-center"><?php echo e($prescription->created_at->format('d M Y H:i')); ?></td>
                                <td class="text-center">
                                    <label class="badge badge-primary-soft">
                                        <?php echo e(count($prescription->Drug)); ?> Drugs
                                    </label>
                                    <label class="badge badge-primary-soft">
                                        <?php echo e(count($prescription->Test)); ?> Tests
                                    </label>
                                </td>
                                <td class="text-center"><?php if($prescription->issued ): ?>
                                    <label class="badge badge-success-soft">
                                        Issued
                                    </label>
                                    <?php else: ?>
                                    <label class="badge badge-danger-soft">
                                        Not Issued
                                    </label>
                                <?php endif; ?></td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view prescription')): ?>
                                        <a href="<?php echo e(url('prescription/view/' . $prescription->id)); ?>"
                                            class="btn btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit prescription')): ?>
                                        <a href="<?php echo e(url('prescription/edit/' . $prescription->id)); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete prescription')): ?>
                                        <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(url('prescription/delete/' . $prescription->id)); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>


                                </td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('issue prescription')): ?>
                                    <td  id="changestauts" class="text-center">
                                        <input type="checkbox" data-id=<?php echo e($prescription->id); ?> data-toggle="toggle"
                                            data-onstyle="secondary" data-on="Approve" data-off="UnApprove"
                                            <?php echo e($prescription->issued ? 'checked' : ''); ?>>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center"><img src="<?php echo e(asset('img/not-found.svg')); ?>"
                                        width="200" /> <br><br> <b class="text-muted">No prescriptions found</b></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <span class="float-right mt-3"><?php echo e($prescriptions->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $('#changestauts input[type="checkbox"]').change(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "<?php echo e(csrf_token()); ?>",
                url: "<?php echo e(route('issuepre')); ?>",
                type: "post",
                data: {
                    val: $(this).prop('checked'),
                    id: $(this).data('id')
                }
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Documents\GitHub\docrino\resources\views/prescription/all.blade.php ENDPATH**/ ?>