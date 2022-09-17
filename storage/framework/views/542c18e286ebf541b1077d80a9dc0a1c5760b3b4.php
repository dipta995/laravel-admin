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
                                    <!--Create Modal -->
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
                                                        <?php echo $__env->make('backend.pages.components._inputs._input_1',
                                                            $input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_student">Save</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade text-left" id="large1" tabindex="-1" role="dialog"
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

                                                    <?php $__currentLoopData = $update_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo $__env->make('backend.pages.components._inputs._input_1',
                                                            $input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-primary update_student">Save</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        </div>


                        <table class="table">
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
                                    <tr id="table-data<?php echo e($value->id); ?>">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($value->{$column['name']}); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            
                                            <button id="editbtn" value="<?php echo e($value->id); ?>" class="badge bg-info"
                                                href="#">Edit</button>
                                            
                                            <a class="badge bg-danger" href="#"  onclick="deleteData(<?php echo e($value->id); ?>)"  >Delete</a>
                                            
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
        $(document).ready(function() {
            // Show data







            //Insert Data
            $(document).on('click', '.add_student', function(e) {
                e.preventDefault();
                $(this).text('Creating..');
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
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            console.log(false)
                        } else {
                            var getid = $(".table tbody");
getid.prepend('<tr id="table-data'+response.id+'"><td>'+ response.id +'</td><?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><td>'+ response.<?php echo e($column["name"]); ?> + '</td><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><td><button id="editbtn" value="'+ response.id +'" class="badge bg-info" >Edit</button><a class="badge bg-danger" href="#"  onclick="deleteData('+ response.id +')">Delete</a></td></tr>')
                            $('#large').modal('hide');
                            <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            $('#<?php echo e($input['name']); ?>').val('');
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        }
                        $('.add_student').text('Save');


                    }
                });
            });

            //Edit data

            $(document).on('click', '#editbtn', function(e) {
                e.preventDefault();

                var id = $(this).val();
                $('#large1').modal('show');
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/tests/" + id + "/edit",
                    success: function(response) {
                        if (response.status == 404) {
                            $('#large1').modal('hide');
                        } else {

                            <?php $__currentLoopData = $update_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                $('.<?php echo e($input['name']); ?>').val(response.student
                                    .<?php echo e($input['name']); ?>);
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            // $('#id').val('id');
                        }
                    }
                });

            });


            //Update Data
            $(document).on('click', '.update_student', function(e) {
                e.preventDefault();
                $(this).text('Updating..');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $('.id').val();

                var data = {
                    <?php $__currentLoopData = $update_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        '<?php echo e($input['name']); ?>': $('.<?php echo e($input['name']); ?>').val(),
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                }
                $.ajax({
                    data: data,
                    url: "http://127.0.0.1:8000/admin/test/update/" + id,
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            console.log(false);
                        } else {
                            deleteData1(id)
                            var getid = $(".table tbody");
getid.prepend('<tr id="table-data'+id+'"><td>'+ id +'</td><?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><td>'+ response.<?php echo e($column["name"]); ?> + '</td><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><td><button id="editbtn" value="'+ id +'" class="badge bg-info" >Edit</button><a class="badge bg-danger" href="#"  onclick="deleteData('+ id +')">Delete</a></td></tr>')
                            $('#large1').modal('hide');
                            // $(':input').val('');

                        }
                        $('.update_student').text('Save');
                    }
                });

            });
        });
            function deleteData(id) {
        Swal.fire({
            title: "Are you Sure?",
            text: "IF confirm data will deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/admin/tests/" + id,
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Thank you'
                        })
                        $("#table-data" + id).remove();

                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        })
                    },
                });
            }
        })
    }

    function deleteData1(id) {

        $("#table-data" + id).remove();
            }






    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/pages/_create.blade.php ENDPATH**/ ?>