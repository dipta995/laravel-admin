<?php if($input['field']=='select'): ?>
<?php
    $viewindex =$input['view_index'];
?>
<div class="form-group">
    <label for="basicInput"><?php echo e($input['name']); ?></label>
    <select name="<?php echo e($input['name']); ?>" <?php echo e(isset($input['required']) ? "required" : ""); ?> class="form-control simple-selector <?php echo e(isset($input['update']) ? $input['name'] : ''); ?>" id="<?php echo e(isset($input['update']) ? '' : $input['name']); ?>">
        <?php $__currentLoopData = getData($input['modelData']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($item->id); ?>"   ><?php echo e($item->$viewindex); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php endif; ?>
<?php if($input['field']=='input'): ?>

<div class="form-group">
    <?php if($input['name']!='id'): ?>
    <label for="basicInput"><?php echo e($input['name']); ?></label>
    <?php endif; ?>
    <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" <?php echo e(isset($input['required']) ? "required" : ""); ?> <?php echo e(isset($input['min']) ? "min=".$input['min'] : ""); ?>   <?php echo e(isset($input['max']) ? "max=".$input['max'] : ""); ?> class="form-control <?php echo e(isset($input['update']) ? $input['name'] : ''); ?>" id="<?php echo e(isset($input['update']) ? '' : $input['name']); ?>"  placeholder="<?php echo e(isset($input['update']) ? '' : $input['placeholder']); ?>">
</div>
<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/pages/components/_inputs/_input_1.blade.php ENDPATH**/ ?>