<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New User')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('New Item')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="<?php echo e($data ? route('stock-category.update', $data) : route('stock-category.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if($data): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('Stock Category')); ?><font
                                    color="red">*</font></label>
                                    <div class="col-sm-9">
                            <input type="text" name="name" value="<?php echo e(($data) ? $data->name : ''); ?>" required class="form-control">
                                    </div>
                        </div>
                        <div class="form-group row">
                            <button class="btn mx-auto btn-primary w-50">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Documents\GitHub\docrino\resources\views/stockcat/create.blade.php ENDPATH**/ ?>