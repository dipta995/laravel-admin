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
                    {{ $pageHeader['title'] }} list
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr id="table-data{{ $data->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->body }}</td>
                                    <td>
                                        <img style="height: 80px; width:80px; border-radious:50%;"
                                            src="{{ asset('images/' . $data->image) }}" alt="">
                                    </td>
                                    @if (Auth::guard('admin')->user()->can('post.edit'))
                                        <td>
                                            <div class="form-check form-switch">
                                                <input
                                                    onclick="activeData({{ $data->id }},'{{ $pageHeader['base_url'] }}')"
                                                    {{ $data->status == 'active' ? 'checked' : '' }}
                                                    class="form-check-input" name="" type="checkbox"
                                                    id="flexSwitchCheckDefault">
                                            </div>
                                        </td>
                                    @endif
                                    <td>
                                        @if (Auth::guard('admin')->user()->can('post.edit'))
                                            <a class="badge bg-info"
                                                href="{{ route($pageHeader['edit_route'], $data->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                        @endif
                                        @if (Auth::guard('admin')->user()->can('post.delete'))
                                            <a class="badge bg-danger" href="javascript:void(0)"
                                                onclick="dataDelete({{ $data->id }},'{{ $pageHeader['base_url'] }}')"><i
                                                    class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="6">No Data Found ! <a class="btn btn-outline-info"
                                            href="{{ route('admin.posts.create') }}">Create
                                            {{ $pageHeader['singular_name'] }}</a>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $datas->links() !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
