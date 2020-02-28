<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fa fa-users nav-icon"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! url('roles') !!}">
        <i class="fa fa-user nav-icon" aria-hidden="true"></i>&nbsp;&nbsp;Roles
    </a>
</li>