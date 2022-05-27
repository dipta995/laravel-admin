@extends('backend.layouts.master')
@section('title')
    Create User
@endsection
@section('admin-content')
@include('backend.layouts.partials.page-header', $pageHeader)
<div class="page-content">
  <!-- Basic Tables start -->
  <section class="section">
    <div class="card">
        <div class="card-header">
            Jquery Datatable
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($admins as $user)
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $item)
                                <span class="badge bg-success">{{ $item->name }}</span>
                                @endforeach
                            </td>

                            <td>
                                @if ( Auth::guard('admin')->user()->can('admin.edit'))
                                <a class="badge bg-info" href="{{ route('admin.admins.edit',$user->id) }}">Edit</a>
                                @endif
                                @if ( Auth::guard('admin')->user()->can('admin.delete'))
                                <a class="badge bg-danger" href="">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach







                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- Basic Tables end -->
    </div>

@endsection
