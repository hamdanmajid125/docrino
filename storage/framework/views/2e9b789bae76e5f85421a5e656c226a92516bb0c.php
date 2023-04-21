
<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.New Patient')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.New Patient')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('patient.create')); ?>" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                     <input type="text" class="form-control" id="Name" name="name">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputPassword4"><?php echo e(__('sentence.Email Adress')); ?><font color="red">*</font></label>
                     <input type="email" class="form-control" id="Email" name="email">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                     <input type="text" class="form-control" id="Phone" name="phone">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                     <input type="date" class="form-control" id="Birthday" name="birthday" autocomplete="off">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                      <input type="text" class="form-control" id="Address" name="adress">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                     <select class="form-control" name="gender" id="Gender">
                        <option value="Male"><?php echo e(__('sentence.Male')); ?></option>
                        <option value="Female"><?php echo e(__('sentence.Female')); ?></option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputZip"><?php echo e(__('sentence.Blood Group')); ?></label>
                     <select class="form-control" name="blood" id="Blood">
                        <option value="Unknown"><?php echo e(__('sentence.Unknown')); ?></option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="inputAddress2"><?php echo e(__('sentence.Patient Weight')); ?></label>
                     <input type="text" class="form-control" id="Weight" name="weight">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="inputAddress"><?php echo e(__('sentence.Patient Height')); ?><font color="red">*</font></label>
                     <input type="text" class="form-control" id="height" name="height">
                  </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-12">
                     <label for="inputState"><?php echo e(__('sentence.Image')); ?></label>
                
                     <input type="file" class="form-control dropify" id="file-upload" name="image">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
  
   .custom-file-upload {
   border: 1px solid #ccc;
   display: inline-block;
   padding: 6px 12px;
   cursor: pointer;
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
     $(function() {
          $('.dropify').dropify();
      });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\123\Documents\GitHub\docrino\resources\views/patient/create.blade.php ENDPATH**/ ?>