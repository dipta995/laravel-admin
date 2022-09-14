<script src="<?php echo e(asset('/backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('/backend/assets/vendors/apexcharts/apexcharts.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/js/pages/dashboard.js')); ?>"></script>


<script src="<?php echo e(asset('/backend/assets/vendors/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js')); ?>"></script>

<script src="<?php echo e(asset('/backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/vendors/fontawesome/all.min.js')); ?>"></script>

<script src="<?php echo e(asset('/backend/assets/vendors/choices.js/choices.min.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/js/pages/form-element-select.js')); ?>"></script>
<script src="<?php echo e(asset('/backend/assets/js/mazer.js')); ?>"></script>
<script>
    // Jquery Datatable
    $(document).ready(function() {
        let jquery_datatable = $("#table1").DataTable();
               jQuery('#track_id').change(function(){
                   let track_id = jQuery(this).val();
                   jQuery.ajax({
                       url:"<?php echo e(url('training_days/')); ?>/"+track_id,
                       type:'get',
                       data:'country_id='+track_id+'&_token=<?php echo e(csrf_token()); ?>',
                       success:function(result){
                           jQuery('#training_day').html(result)
                       }
                   });
               });
            });
</script>

<?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/layouts/partials/script.blade.php ENDPATH**/ ?>