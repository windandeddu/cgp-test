<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route('companies.index') }}" class="nav-link {{ Request::is('companies') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Companies</p>
    </a>
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>Clients</p>
    </a>
</li>
