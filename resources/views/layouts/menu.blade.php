<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fa fa-user nav-icon"></i>
        <span>Users</span>
    </a>
</li>
