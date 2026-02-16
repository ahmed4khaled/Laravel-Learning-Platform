@include('layout.sider')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to
                                    download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                            Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy
                                    with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                            Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Buttons</h1>

            <div class="row">

                <div class="col-lg-6">
                    <!-- Circle Buttons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">QR Creation</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="qr" class="form-label">Qrs</label>
                                    <input type="number" class="form-control" name="qr" id="qr">
                                </div>
                                <div class="mb-3">
                                    <label for="RoleQR" class="form-label">Role</label>
                                    <select class="form-control" id="RoleQR" name="RoleQR">
                                        <option class="selects" value=1>Weekly </option>
                                        <option class="selects" value=4> Monthly </option>
                                        <option class="selects" value=8>Term </option>
                                        <option class="selects" value=10>Bandle</option>
                                        <option class="selects" value=3>Geo</option>

                                    </select>
                                    <div class="mb-3">
                                        <label for="dis" class="form-label">DisCount</label>
                                        <input type="text" class="form-control" id="dis" name="dis">
                                    </div>
                                    <div class="mb-3">
                                        <label for="std" class="form-label">std</label>
                                        <input type="text" class="form-control" id="std" name="std">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- Circle Buttons (Small) -->
                            <div class="mt-4 mb-2">
                                <code>Search(Lecname sale,cobon)</code>
                            </div>
                            <form action="{{ route('Qr.search') }}" method="POST">
                                @csrf
                                {{-- <div class="mb-3">
                                    <label for="qr" class="form-label">Lec name</label>
                                    <input type="number" class="form-control" name="lecname" id="qr">
                                </div> --}}
                                <div class="mb-3">
                                    <label for="RoleQR" class="form-label">Cobon</label>
                                    <input type="number" class="form-control" name="cobon" id="qr">

                                    {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="RoleQR" class="form-label">Role</label>
                                        <select class="form-control" id="RoleQR" name="role">
                                            <option class="selects" value=1>Weekly </option>
                                            <option class="selects" value=4> Monthly </option>
                                            <option class="selects" value=8>Term </option>
                                            <option class="selects" value=10>Bandle</option>
                                        </select>
                                        {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="RoleQR" class="form-label">Std</label>
                                        <input type="text" class="form-control" name="value" id="qr">

                                        {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- Circle Buttons (Large) -->
                            @if (isset($Data))
                                <div class="mt-4 mb-2">
                                    <code>Num of {{ count($Data) }}</code>
                                </div>

                        </div>
                    </div>

                    <!-- Brand Buttons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-5">
                            <h6 class="m-0 font-weight-bold text-primary">Result</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                {{-- @dd($Data) --}}
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Qr</th>
                                        <th scope="col">value</th>
                                        <th scope="col">User_id</th>
                                        <th scope="col">Used</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Cobon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Data as $item)
                                        <tr>
                                            <th scope="row">{{ $item['id'] }}</th>
                                            <td>{{ $item['qr'] }}</td>
                                            <td>{{ $item['value'] }}</td>
                                            <td>{{ $item['user_id'] }}</td>
                                            <td>{{ $item['used'] }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                            <td>{{ $item['copon'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                        @endif

                    </div>

                </div>

                <div class="col-lg-40">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Search</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('Qr.searchb') }}" method="POST">
                                @csrf
                                {{-- <div class="mb-3">
                                    <label for="qr" class="form-label">Lec name</label>
                                    <input type="number" class="form-control" name="lecname" id="qr">
                                </div> --}}
                                <div class="mb-3">
                                    <label for="RoleQR" class="form-label">Search Qr</label>
                                    <input type="text" class="form-control" name="QR_search" id="qr">

                                    {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- Circle Buttons (Large) -->
                            @if (isset($Dataa))
                                <div class="mt-4 mb-2">
                                    <code>Num of {{ count($Dataa) }}</code>
                                </div>

                        </div>
                    </div>

                    <!-- Brand Buttons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-5">
                            <h6 class="m-0 font-weight-bold text-primary">Result</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                {{-- @dd($Data) --}}
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Qr</th>
                                           <th scope="col">Lec</th>
                                           
                                        <th scope="col">User_id</th>
                                                                                <th scope="col">Phone</th>

                                        <th scope="col">Created</th>
                                        {{-- <th scope="col">Handle</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Dataa as $item)
                                        <tr>
                                            <th scope="row">{{ $item['id'] }}</th>
                                            <td>{{ $item['qr'] }}</td>
                                                                                        <td>{{ $item['Lecname'] }}</td>
                                                                                                                              <td>{{ $item['user_id'] }}</td>
      
                                            <td>{{ $item['Phone'] }}</td>

                                            <td>{{ $item['created_at'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                        @endif

                    </div>
                    <div class="card-body">
                        <form action="{{ route('sea') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="RoleQR" class="form-label">Search User</label>
                                <input type="text" class="form-control" name="sea" id="qr">

                                {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                          <form action="{{ route('sea_id') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="RoleQR" class="form-label">Search Id</label>
                                <input type="text" class="form-control" name="sea_id" id="qr">

                                {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <!-- Circle Buttons (Large) -->
                        @if (isset($Dataaa))
                            <div class="mt-4 mb-2">
                                <code>Num of {{ count($Dataaa) }}</code>
                            </div>

                    </div>
                </div>

                <!-- Brand Buttons -->
                <div class="card shadow mb-4">
                    <div class="card-header py-5">
                        <h6 class="m-0 font-weight-bold text-primary">Result</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            {{-- @dd($Data) --}}
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Phone_par</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                                                        <th scope="col">Qrs</th>
                                    <th scope="col">Lecs</th>

                                    {{-- <th scope="col">Handle</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Dataaa as $item)
                                    <tr>
                                        {{-- @dd($Dataaa); --}}
                                        <th scope="row">{{ $item['id'] }}</th>
                                        {{-- <td>{{ $Dataaa['qr'] }}</td> --}}
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['Phone'] }}</td>
                                        <td>{{ $item['Phone_par'] }}</td>
                                        <td><a href="{{ route('Edit_user', $item['id']) }}" type="button"
                                                class="btn btn-success">Edit</a></td>
                                                <td><a href="{{ route('delete_user', $item['id']) }}" type="button"
                                            class="btn btn-danger">Delete</a></td>
                                                 <td><a href="{{ route('Qrs_user', $item['id']) }}" type="button"
                                        class="btn btn-success">Qrs</a></td>
                                <td><a href="{{ route('Lec_user', $item['id']) }}" type="button"
                                        class="btn btn-danger">Lecs</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div>

</div>

</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assest/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assest/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assest/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src=" {{ asset('assest/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assest/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assestjs/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
