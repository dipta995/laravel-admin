<div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>{{ $pageHeader['title'] }}</h3>
        <p class="text-subtitle text-muted">{{ $pageHeader['sub_title'] }}</p>
    </div>

    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-outline-info btn-sm" href="{{ route('admin.home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if (Route::is('admin.' . $pageHeader['plural_name'] . '.create') ||
                        Route::is('admin.' . $pageHeader['plural_name'] . '.edit'))
                        <a class="btn btn-outline-info btn-sm"
                           href="{{ ($pageHeader['index_route']) }}">{{ $pageHeader['title'] }}</a>
                    @else
                        @if (!Route::is('home'))
                            <a class="btn btn-outline-info btn-sm"
                               href="{{ ($pageHeader['store_route']) }}">Create {{ $pageHeader['title'] }}</a>
                        @else
                            <a class="btn btn-outline-info btn-sm"
                               href="{{ ($pageHeader['store_route']) }}">{{ $pageHeader['title'] }}</a>
                        @endif
                    @endif
                </li>
            </ol>
        </nav>
    </div>
</div>
