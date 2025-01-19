<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">TIKET KONSER</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">TK</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('users') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('users.index') }}">User</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link" href="{{ route('konser.index') }}">Konser</a>
                    </li>
                    <li class=''>
                        <a class="nav-link" href="{{ route('rekening.index') }}">Rekening</a>
                    </li>
                    
                    <li class=''>
                        <a class="nav-link" href="{{ route('category.index') }}">Kategori</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('admin.pesanan') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('admin.pesanan.index') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Pesanan</span>
                </a>
            </li>
            <li class="{{ Request::is('faq') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('faq.index') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>FAQ</span>
                </a>
            </li>
</div>
