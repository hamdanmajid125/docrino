<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New User')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('Create Category')); ?></h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e($data ? route('stock.update', $data) : route('stock.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('Stock Category')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control" id="">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(($data)?($item->id == $data->stock_category_id ? 'selected' : ''):''); ?>><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('Name')); ?><font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo e($data ? $data->name : ''); ?>" class="form-control"
                                    id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('Quantity')); ?><font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="number" value="<?php echo e($data ? $data->qty : ''); ?>" class="form-control"
                                    id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label"><?php echo e(__('Stock Category')); ?><font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control" id="">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e(($data)?($item->id == $data->assigned_to ? 'selected' : ''):''); ?>><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <button class="btn btn-primary mx-auto w-50 " type="submit">Save</button>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Documents\GitHub\docrino\resources\views/stock/create.blade.php ENDPATH**/ ?>