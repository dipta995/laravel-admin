@php
    $userGuard = Auth::guard('admin')->user();
@endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{route('admin.home')}}"><img src="{{ asset('backend/assets/images/logo/logo.png') }}" alt="Logo"
                            srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="{{route('admin.home')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- Role --}}
                @if (
                    $userGuard->can('role.view') ||
                        $userGuard->can('role.create') ||
                        $userGuard->can('role.edit') ||
                        $userGuard->can('role.delete'))
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Roles</span>
                        </a>
                        <ul class="submenu"
                            {{ Route::is('admin.roles.create') || Route::is('admin.roles.edit') || Route::is('admin.roles.index') ? 'style=display:block;' : '' }}>
                            <li class="submenu-item ">
                                @if ($userGuard->can('role.view'))
                                    <a {{ Route::is('admin.roles.edit') || Route::is('admin.roles.index') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.roles.index') }}">Roles</a>
                                @endif
                                @if ($userGuard->can('role.create'))
                                    <a {{ Route::is('admin.roles.create') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.roles.create') }}">Create Role</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- Admin --}}
                @if (
                    $userGuard->can('admin.view') ||
                        $userGuard->can('admin.create') ||
                        $userGuard->can('admin.edit') ||
                        $userGuard->can('admin.delete'))
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Admins</span>
                        </a>
                        <ul class="submenu"
                            {{ Route::is('admin.admins.create') || Route::is('admin.admins.edit') || Route::is('admin.admins.index') ? 'style=display:block;' : '' }}>
                            <li class="submenu-item ">
                                @if ($userGuard->can('admin.view'))
                                    <a {{ Route::is('admin.admins.edit') || Route::is('admin.admins.index') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.admins.index') }}">Admins</a>
                                @endif
                                @if ($userGuard->can('admin.create'))
                                    <a {{ Route::is('admin.admins.create') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.admins.create') }}">Create Admin</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- User --}}
                @if (
                    $userGuard->can('user.view') ||
                        $userGuard->can('user.create') ||
                        $userGuard->can('user.edit') ||
                        $userGuard->can('user.delete'))
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Users</span>
                        </a>
                        <ul class="submenu"
                            {{ Route::is('admin.users.create') || Route::is('admin.users.edit') || Route::is('admin.users.index') ? 'style=display:block;' : '' }}>
                            <li class="submenu-item ">
                                @if ($userGuard->can('user.view'))
                                    <a {{ Route::is('admin.users.edit') || Route::is('admin.users.index') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.users.index') }}">Users</a>
                                @endif
                                @if ($userGuard->can('user.create'))
                                    <a {{ Route::is('admin.users.create') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.users.create') }}">Create User</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- Post --}}
                @if (
                    $userGuard->can('post.view') ||
                        $userGuard->can('post.create') ||
                        $userGuard->can('post.edit') ||
                        $userGuard->can('post.delete'))
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Posts</span>
                        </a>
                        <ul class="submenu"
                            {{ Route::is('admin.posts.create') || Route::is('admin.posts.edit') || Route::is('admin.posts.index') ? 'style=display:block;' : '' }}>
                            <li class="submenu-item ">
                                @if ($userGuard->can('post.view'))
                                    <a {{ Route::is('admin.posts.edit') || Route::is('admin.posts.index') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.posts.index') }}">Posts</a>
                                @endif
                                @if ($userGuard->can('post.create'))
                                    <a {{ Route::is('admin.posts.create') ? 'style=color:#435ebe;' : '' }}
                                        href="{{ route('admin.posts.create') }}">Create Post</a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="sidebar-title">Raise Support</li>

                <li class="sidebar-item  ">
                    <form method="POST" action="{{ route('admin.logout.submit') }}" x-data>
                        @csrf
                        <button type="submit" class="btn-primary  bi-emoji-frown-fill text-uppercase p-1 "> Log
                            Out</button>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
