
<div class="form-group">
    <label for="basicInput"><?php echo e($input['name']); ?></label>
    <input type="<?php echo e($input['type']); ?>" name="<?php echo e($input['name']); ?>" <?php echo e(isset($input['required']) ? "required" : ""); ?> <?php echo e(isset($input['min']) ? "min=".$input['min'] : ""); ?>   <?php echo e(isset($input['max']) ? "max=".$input['max'] : ""); ?> class="form-control <?php echo e(isset($input['update']) ? $input['name'] : ''); ?>" id="<?php echo e(isset($input['update']) ? '' : $input['name']); ?>"  placeholder="<?php echo e(isset($input['update']) ? '' : $input['placeholder']); ?>">
</div>

<?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/pages/components/_inputs/_input_1.blade.php ENDPATH**/ ?>