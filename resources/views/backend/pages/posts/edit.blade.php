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
                    <h4 class="card-title">
                        Edit {{ $pageHeader['singular_name'] }}
                    </h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route($pageHeader['update_route'], $singleData->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        value="{{ old('title', $singleData->title) }}">
                                    @error('title')
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="summernote" class="form-control @error('body') is-invalid @enderror">"{!! $singleData->body !!}"
                                           </textarea>
                                    @error('body')
                                        <strong class="text-danger">{{ $errors->first('body') }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <img style="height:150px; width:150px; border-radious:50%;"
                                                src="{{ asset('images/' . $singleData->image) }}" alt="">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-success">Update
                                    {{ $pageHeader['singular_name'] }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
