
@extends('backend.layouts.master')
@section('title')
    {{ $pageHeader['title'] }}
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
                        <th>Permissions</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($roles as $role)
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $item)
                                <span class="badge bg-success">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ( Auth::guard('admin')->user()->can('role.edit'))
                                <a class="badge bg-info" href="{{ route('admin.roles.edit',$role->id) }}">Edit</a>
                                @endif
                                @if ( Auth::guard('admin')->user()->can('role.delete'))
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
