@include('layout.sider')


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        {{-- @extends('layout.app') --}}
        {{-- @section('content') --}}
        {{-- @include('layout.navbar') --}}
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-12">
                    <form action="{{ route('Edit.1', $user->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">User Name</label>
                            <input value='{{ $user->name }}' name="Name" class="form-control form-control-lg mt-3"
                                type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Phone</label>
                            <input value={{ $user->Phone }} name="Phone" class="form-control form-control-lg mt-3"
                                type="text" placeholder="Default input" aria-label="default input example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>

                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Phone_parent</label>
                            <input value={{ $user->Phone_par }}
                                name="Phone_par"class="form-control form-control-lg mt-3" type="text"
                                placeholder="Default input" aria-label="default input example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">School</label>
                            <input 
                                name="school"class="form-control form-control-lg mt-3" type="text"
                                placeholder="School" aria-label="default input example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Phone</label>
                            <input name="pass" class="form-control form-control-lg mt-3" type="text"
                                placeholder="New Password" aria-label=".form-control-sm example">
                        </div>
                        <button type="submit" class="btn btn-primary">Primary</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        </body>

        </html>
