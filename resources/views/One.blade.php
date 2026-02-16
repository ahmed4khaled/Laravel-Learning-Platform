@include('layout.sider')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
=

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
                            <h6 class="m-0 font-weight-bold text-primary">Lec Creation</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('create.one') }}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="mb-3">
                                    <label for="des" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="des" id="des">
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">img</label>
                                    <input type="file" name="img" id="img">
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">price</label>
                                    <input type="text" class="form-control" name="price" id="img">
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">Dead Time</label>
                                    <input type="text" class="form-control" name="Time" id="img">
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
                                </div>

                                         <div class="mb-3">
                                    <label for="exam" class="form-label">Exams</label>
                                    <select class="form-control" id="exam" name="exam">
                                        @foreach ($exams->whereNotNull('lecture_id') as $exam)

                                            <option class="selects" value="{{ $exam->id }}">{{ $exam->title }}</option>
                                            @endforeach
                                 
                                        </select>
                                      
                                    

                                </div>
                                   
                                    <div class="mb-3">
                                        <label for="Monthly" class="form-label">Monthly</label>
                                        <input type="text" class="form-control" name="Monthly" id="Monthly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="term" class="form-label">term</label>
                                        <input type="text" class="form-control" name="term" id="term">
                                    </div>
                                    <div class="mb-3">
                                        <label for="std" class="form-label">Std</label>
                                        <input type="text" class="form-control" name="std" id="std">
                                    </div>

                                    <div class="mb-3">
                                        <label for="subname" class="form-label">Sub
                                            NameSub</label>
                                        <input type="text" class="form-control" name="subname" id="subname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Links</label>
                                        <input type="text" class="form-control" name="link" id="link">
                                    </div>
                                    {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
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
                                    <input type="text" class="form-control" name="cobon" id="qr">

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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Result</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                {{-- @dd($Data) --}}
                                <thead>

                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col">Qr</th> --}}
                                        <th scope="col">Used</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Cobon</th>
                                        <th scope="col">Handle</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($Data as $item)
                                        <tr>
                                            <th scope="row">{{ $item['id'] }}</th>
                                            {{-- <td>{{ $item['qr'] }}</td> --}}
                                            <td>{{ $item['used'] }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                            <td>{{ $item['copon'] }}</td>
                                            <td>{{ $item['copon'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                        @endif

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Split Buttons with Icon</h6>
                        </div>
                        <div class="card-body">

                            <a href="#" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Split Button Primary</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Split Button Success</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Split Button Info</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-warning btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Split Button Warning</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Split Button Danger</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Split Button Secondary</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-light btn-icon-split">
                                <span class="icon text-gray-600">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Split Button Light</span>
                            </a>
                            <div class="mb-4"></div>
                            <p>Also works with small and large button classes!</p>
                            <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Split Button Small</span>
                            </a>
                            <div class="my-2"></div>
                            <a href="#" class="btn btn-primary btn-icon-split btn-lg">
                                <span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Split Button Large</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->

    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


</a>
</div>



</body>

</html>
