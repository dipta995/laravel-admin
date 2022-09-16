@extends('backend.layouts.master')
@section('title')
    {{ $pageHeader['title'] }}
@endsection
@section('admin-content')
    @include('backend.layouts.partials.page-header', $pageHeader)
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Inputs</h4>
                </div>

                {{-- View --}}
                @if (isset($view_data))
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

                                                        @foreach($update_fields as $input)
                                                            @include("backend.pages.components._inputs._input_1",$input)
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary update_student">Save</button>
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
                                @foreach($show_fields as $column)
                                    <td>{{ $column['view_name'] }}</td>
                                @endforeach
                                <th>Action</th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($view_data as $value)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    @foreach($show_fields as $column)
                                        <td>{{ $value->{$column['name']} }}</td>
                                    @endforeach
                                    <td>
                                        {{-- @if ( Auth::guard('admin')->user()->can('role.edit')) --}}
                                        <button id="editbtn" value="{{ $value->id }}" class="badge bg-info" href="#">Edit</button>
                                        {{-- @endif
                                            @if ( Auth::guard('admin')->user()->can('role.delete')) --}}
                                        <button class="badge bg-danger" href="">Delete</button>
                                        {{-- @endif --}}
                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                {{-- View --}}



{{--                @if (isset($update_fields))--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <form action="{{ $route }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @if (isset($data))--}}
{{--                                        @method('PUT')--}}
{{--                                    @endif--}}





{{--                                    @foreach($update_fields as $input)--}}
{{--                                        @include("backend.pages.components._inputs._input_1",$input)--}}
{{--                                    @endforeach--}}

{{--                                    <button type="submit" class="btn btn-outline-success">With Buttons</button>--}}
{{--                                </form>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}



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
                    @foreach($insert_fields as $input)
                    '{{ $input['name'] }}': $('#{{ $input['name'] }}').val(),
                    @endforeach
                }
            $.ajax({
                data: data,
                url: "{{ $route_create }}",
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
                $('#large1').modal('show');
                $.ajax({
                    type: "GET",
                    url: "http://127.0.0.1:8000/admin/tests/"+ id +"/edit",
                    success: function (response) {
                        if (response.status == 404) {
                            $('#large1').modal('hide');
                        } else {
                            @foreach($update_fields as $input)
                            $('#{{ $input['name'] }}').val(response.student.{{ $input['name'] }});
                            @endforeach
                            // $('#id').val('id');
                        }
                    }
                });


            });


            //Update Data
            $(document).on('click', '.update_student', function (e) {
            e.preventDefault();

            // $(this).text('Updating..');
            var id = 1;
            // alert(id);

            var data = {
                @foreach($insert_fields as $input)
                    '{{ $input['name'] }}': $('#{{ $input['name'] }}').val(),
                @endforeach
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "http://127.0.0.1:8000/admin/tests/"+ id,
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {

                    } else {

                        // fetchstudent();
                    }
                }
            });

        });




            });

    </script>

@endsection
