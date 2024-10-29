
<aside class="main-sidebar sidebar-dark-navy elevation-4" style="height: 100vh">
    <!-- System title and logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light font-size"><h5>FAS System</h5></span>
    </a> <!-- System title and logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview">
                    <a href="../" class="nav-link">
                       <i class="nav-icon fa-solid fa-arrow-left"></i>
                        <p>Return to Rapidx</p>
                    </a>
                </li>

                    {{-- <li class="nav-header mt-3 font-weight-bold">Dashboard</li> --}}
                        <li class="nav-item has-treeview">
                            <a href="{{ route("dashboard") }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-arrow-left"></i>
                                 <p>Return to Dashboard</p>
                             </a>
                        </li>

                {{-- <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <div class="d-flex justify-content-between align-items-center">
                                <p><i class="fa-solid fa-boxes-packing"></i> System Lists </p>
                                <i class="fas fa-angle-down"> </i>
                            </div>
                        </a>
                </li> --}}
                

                    {{-- <ul class="nav-item nav-treeview">  commented dropdown --}}
                    <li class="nav-item nav-treeview">
                        <li>
                            <a href="#" class="nav-link">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa-solid fa-boxes-packing"></i> JO Request System</p>
                                    <i class="fas fa-angle-left"> </i>
                                </div>
                            </a>

                            @if (in_array($_SESSION['fas_section'], ['ISS', 'FAS']) || in_array($_SESSION['fas_access_level'], [3]))
                                <ul class="nav-item nav-treeview"> 
                                    <a href="{{ route("user_access") }}" class="nav-link">
                                        <i class="far fa-circle nav-icon ml-1"> </i>
                                        <p>User</p>
                                    </a>
                                </ul>
                            @endif
                           

                            <ul class="nav-item nav-treeview"> 
                                <a href="{{ route("jo_request") }}" class="nav-link">
                                    <i class="far fa-circle nav-icon ml-1"> </i>
                                    <p>JO Requests</p>
                                </a>
                            </ul>

                            {{-- <ul class="nav-item nav-treeview"> 
                                <a href="{{ route("jo_request_conformance") }}" class="nav-link">
                                    <i class="far fa-circle nav-icon ml-1"> </i>
                                    <p>JO Conformance</p>
                                </a>
                            </ul> --}}
                        </li>

                        {{-- <li>
                            <a href="#" class="nav-link">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p><i class="fa-solid fa-boxes-packing"></i> test 2</p>
                                    <i class="fas fa-angle-left"> </i>
                                </div>
                            </a>
                            <ul class="nav-item nav-treeview"> 
                                <a href="{{ route("dashboard") }}" class="nav-link">
                                    <i></i>
                                    <p>Dashboard</p>
                                </a>
                            </ul>
                        </li> --}}

                    </li> 
            </ul>
        </nav>
    </div><!-- Sidebar -->
</aside>