<script src="{{ asset('/backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('/backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('/backend/assets/js/pages/dashboard.js') }}"></script>


<script src="{{ asset('/backend/assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
</script>
<script src="{{ asset('/backend/assets/vendors/fontawesome/all.min.js') }}"></script>

<script src="{{ asset('/backend/assets/vendors/choices.js/choices.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/pages/form-element-select.js') }}"></script>
<script src="{{ asset('/backend/assets/js/mazer.js') }}"></script>
<script src="{{ asset('/backend/assets/vendors/summernote/summernote-lite.min.js') }}"></script>
<script>
    // Jquery Datatable
    $(document).ready(function() {
        let jquery_datatable = $("#table1").DataTable();
        jQuery('#track_id').change(function() {
            let track_id = jQuery(this).val();
            jQuery.ajax({
                url: "{{ url('training_days/') }}/" + track_id,
                type: 'get',
                data: 'country_id=' + track_id + '&_token={{ csrf_token() }}',
                success: function(result) {
                    jQuery('#training_day').html(result)
                }
            });
        });
    });

    // Summernote
    $('#summernote').summernote({
        tabsize: 2,
        height: 120,
    })

    $("#hint").summernote({
        height: 100,
        toolbar: false,
        placeholder: 'type with apple, orange, watermelon and lemon',
        hint: {
            words: ['apple', 'orange', 'watermelon', 'lemon'],
            match: /\b(\w{1,})$/,
            search: function(keyword, callback) {
                callback($.grep(this.words, function(item) {
                    return item.indexOf(keyword) === 0;
                }));
            }
        }
    });

    // Delete Data
    function dataDelete(id, url_base_name) {
        Swal.fire({
            title: "Are you sure to delete ?",
            text: "Maybe this data will be deleted permanently ",
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
                    url: url_base_name + "/" + id,
                    type: "DELETE",
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Successfully Deleted !'
                            })
                            $("#table-data" + id).remove();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong, Try again !'
                            })
                        }
                    },
                    error: function(response) {

                    },
                });
            }
        })
    }

    // Active Status Ajax
    function activeData(id, base_url) {
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
            url: base_url + "/status/" + id,
            type: "GET",
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function(response) {

                Toast.fire({
                    icon: 'success',
                    title: 'Success !'
                })

            },
            error: function(response) {
                Toast.fire({
                    icon: 'error',
                    title: 'Opps! Something Wrong.'
                })
            },
        });
    }
</script>
