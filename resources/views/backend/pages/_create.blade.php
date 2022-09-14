
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
                                        {{-- <a class="badge bg-info" href="{{ route($route,$value->id) }}">Edit</a> --}}
                                        {{-- @endif
                                            @if ( Auth::guard('admin')->user()->can('role.delete')) --}}
                                            <a class="badge bg-danger" href="">Delete</a>
                                            {{-- @endif --}}
                                        </td>

                                </tr>

                                @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                {{-- View --}}


                {{-- Input --}}
                @if (isset($insert_fields) || isset($update_fields))
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ $route }}" method="POST">
                                @csrf
                                @if (isset($data))
                                @method('PUT')
                                @endif
                                @foreach($insert_fields as $input)
                                    @include("backend.pages.components._inputs._input_1",$input)
                                @endforeach

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                            </form>

                        </div>

                    </div>
                </div>
                @endif
                {{-- Input --}}


            </div>
        </section>

    </div>

@endsection
