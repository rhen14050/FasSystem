<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link">FAS System</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <div class="navbar-nav">
        <li class="nav-item">
            <i class="fas fa-user"></i>
            {{ $_SESSION["rapidx_name"] }}
           
        </li>
    </div>
</nav>

<div class="modal fade" id="modalLogout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> Logout</h4>
                <button type="button" class="btn-close" style="margin-top: 3px;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formSignOut">
                @csrf
                <div class="modal-body">
                    <p id="lblSignOut" class="mt-2 theme-color">Are you sure to logout your account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default theme-color" data-bs-dismiss="modal">No</button>
                    <button type="button" id="btnLogout" class="btn theme-color-bg text-white"><i id="iconLogout" class="fa fa-check"></i> Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>