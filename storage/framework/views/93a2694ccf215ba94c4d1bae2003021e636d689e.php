<?php $__env->startSection('title'); ?>
    <?php echo e($pageHeader['title']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-content'); ?>
    <?php echo $__env->make('backend.layouts.partials.page-header', $pageHeader, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Inputs</h4>
                </div>

                
                <?php if(isset($view_data)): ?>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-12">
                                <div class="me-1 mb-1 d-inline-block">
                                    <!-- Button trigger for large size modal -->
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#large">
                                        Create
                                    </button>
                                    <!--large size Modal -->
                                    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                             role="document">
                                            <div class="modal-content">





                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo $__env->make("backend.pages.components._inputs._input_1",$input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>





                                                        <button type="submit" class="btn btn-primary add_student update_student">Save</button>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <table class="table" id="table1">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e($column['view_name']); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th>Action</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $view_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index+1); ?></td>
                                    <?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($value->{$column['name']}); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        
                                        <button id="editbtn" value="<?php echo e($value->id); ?>" class="badge bg-info" href="#">Edit</button>
                                        
                                        <button class="badge bg-danger" href="">Delete</button>
                                        
                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
































            </div>
        </section>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            //Insert Data
            $(document).on('click', '.add_student', function (e) {
                e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                var data = {
                    <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '<?php echo e($input['name']); ?>': $('#<?php echo e($input['name']); ?>').val(),
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                }
            $.ajax({
                data: data,
                url: "<?php echo e($route_create); ?>",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        console.log(false)
                    } else {
                        $('#large').modal('hide');
                        $(':input').val('');
                    }

                }
            });
            });

            //Edit data

            $(document).on('click', '#editbtn', function (e) {
                e.preventDefault();

                var id = $(this).val();
                $('#large').modal('show');
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/tests/"+ id +"/edit",
                    success: function (response) {
                        if (response.status == 404) {
                            $('#large').modal('hide');
                        } else {
                            <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            $('#<?php echo e($input['name']); ?>').val(response.student.<?php echo e($input['name']); ?>);
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            $('#id').val(id);
                        }
                    }
                });


            });


            //Update Data

            $(document).on('click', '.update_student', function (e) {
                e.preventDefault();

                $(this).text('Updating..');
                var id = $('#editid').val();
                // alert(id);

                var data = {
                    'name': $('#name').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-student/" + id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#update_msgList').html("");
                            $('#update_msgList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#update_msgList').append('<li>' + err_value +
                                    '</li>');
                            });
                            $('.update_student').text('Update');
                        } else {
                            $('#update_msgList').html("");

                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editModal').find('input').val('');
                            $('.update_student').text('Update');
                            $('#editModal').modal('hide');
                            fetchstudent();
                        }
                    }
                });

            });



            });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_laravel_nine\resources\views/backend/pages/_create.blade.php ENDPATH**/ ?>