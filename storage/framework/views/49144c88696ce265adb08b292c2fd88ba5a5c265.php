

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.All Stocks')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('All Stocks')); ?></h6>
                </div>
                <div class="col-4">
                    <?php if(auth()->check() && auth()->user()->hasRole('Supervisor')): ?>
                        <a href="<?php echo e(route('request-furniture.create')); ?>" class="btn btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> <?php echo e(__('New Stocks')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center"><?php echo e(__('Request From')); ?></th>
                            <th class="text-center"><?php echo e(__('Item')); ?></th>
                            <th class="text-center"><?php echo e(__('Item Category')); ?></th>
                            <th class="text-center"><?php echo e(__('Quantity')); ?></th>
                            <th class="text-center"><?php echo e(__('Status')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Register Date')); ?></th>
                            <?php if(auth()->check() && auth()->user()->hasRole('Supervisor')): ?>
                                <th class="text-center"><?php echo e(__('Actions')); ?></th>
                            <?php endif; ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($request->id); ?></td>
                                <td><?php echo e($request->user->name); ?></td>
                                <td><?php echo e($request->stock->name); ?></td>
                                <td><?php echo e($request->stock->category->name); ?></td>

                                <td class="text-center"><?php echo e($request->qty); ?> units</td>
                                <td class="text-center">

                                    <span
                                        class="badge badge-<?php echo e($request->approved ? 'success' : 'danger'); ?>"><?php echo e($request->approved ? 'Approved' : 'Pending'); ?></span>

                                </td>
                                <td><label
                                        class="badge badge-primary-soft"><?php echo e($request->created_at->format('d M Y H:i')); ?></label>
                                </td>
                                <?php if(auth()->check() && auth()->user()->hasRole('Supervisor')): ?>
                                    <td class="text-center" id="changestauts">
                                        <input type="checkbox" data-id=<?php echo e($request->id); ?> data-toggle="toggle"
                                            data-onstyle="secondary" data-on="Approve" data-off="UnApprove"
                                            <?php echo e($request->approved ? 'checked' : ''); ?>>
                                    </td>
                                <?php endif; ?>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>

                <span class="float-right mt-3"><?php echo e($data->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
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
                url: "<?php echo e(route('changestautsrequest')); ?>",
                type: "post",
                data: {
                    val: $(this).prop('checked'),
                    id: $(this).data('id')
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HAMDAN\Documents\GitHub\docrino\resources\views/request_furniture/index.blade.php ENDPATH**/ ?>