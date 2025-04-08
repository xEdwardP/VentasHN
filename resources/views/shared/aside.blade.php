    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @can('Cashier-permits')
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                        href="{{ route('new-sale') }}">
                        <i class="fa-solid fa-cash-register"></i><span>Ventas</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('new-sale') }}">
                                <i class="bi bi-circle"></i><span>Vender Productos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sale-details') }}">
                                <i class="bi bi-circle"></i><span>Consultar Ventas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sales-reports') }}">
                                <i class="bi bi-circle"></i><span>Reportes</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('Admin-permits')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('categories') }}">
                        <i class="fa-solid fa-list"></i>
                        <span>Categorias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('customers') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('graphics') }}">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        <span>Graficos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('suppliers') }}">
                        <i class="fa-solid fa-truck"></i>
                        <span>Proveedores</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#productos-nav" data-bs-toggle="collapse" href="#">
                        <i class="fa-solid fa-cart-shopping"></i><span>Productos</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="productos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('products') }}">
                                <i class="bi bi-circle"></i><span>Administrar productos</span>
                            </a>
                        </li>
                        {{-- <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Reportes de productos</span>
                        </a>
                    </li> --}}
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('users') }}">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
            @endcan
        </ul>

    </aside>
