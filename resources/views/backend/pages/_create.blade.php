
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.admins.store') }}" method="POST">
                                @csrf
                                @foreach($insert_fields as $input)
                                    @include("backend.pages.components._inputs._input_1",$input)
                                @endforeach

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
