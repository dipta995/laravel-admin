@extends('backend.layouts.master')
@section('title')
    Create User
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
                        <div class="col-md-6">
                           <form action="{{ route('admin.admins.update',$admin->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="basicInput">Name</label>
                                <input type="text" name="name" class="form-control" id="basicInput" value="{{ $admin->name }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Username</label>
                                <input type="text" name="username" class="form-control" id="basicInput" value="{{ $admin->username }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" name="email" class="form-control" id="basicInput" value="{{ $admin->email }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="text" name="password" class="form-control" id="basicInput" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Confirm Password</label>
                                <input type="text" name="password_confirmation" class="form-control" id="basicInput" placeholder="Enter Confirm Password">
                            </div>


                            <div class="form-group">
                                <select name="roles[]" class="choices form-select multiple-remove" multiple="multiple">

                                        @foreach ($roles as $role)

                                        <option {{ $admin->hasRole($role->name) ? 'selected':'' }}  value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach



                                </select>
                            </div>


                              {{-- <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox
                                    input</label>
                            </div> --}}

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                           </form>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
