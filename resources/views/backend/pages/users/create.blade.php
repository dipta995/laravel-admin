
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
                    <h4 class="card-title">
                        Create New {{ $pageHeader['singular_name'] }}
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                           <form action="{{ route($pageHeader['store_route']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Enter name">
                                @error('name')
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Enter email">
                                @error('email')
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Enter password">
                                @error('password')
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" placeholder="Enter confirm password">
                                @error('password_confirmation')
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-outline-success">Create
                                {{ $pageHeader['singular_name'] }}</button>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
