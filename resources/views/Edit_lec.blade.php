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
                {{-- @dd($lec) --}}
                <div class="col-md-12">
                    <form action="{{ route('Edit.2', [$std, $lec->id]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label"> Name</label>
                            <input value='{{ $lec->title }}' name="Name" class="form-control form-control-lg mt-3"
                                type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Files</label>
                            <input value='{{ $lec->description }}' name="File"
                                class="form-control form-control-lg mt-3" type="text" placeholder="Default input"
                                aria-label="default input example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>

                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Dead Time</label>
                            <input value='{{ $lec->Time }}' name="Time"class="form-control form-control-lg mt-3"
                                type="text" placeholder="Default input" aria-label="default input example">
                            {{-- <input type="number" class="form-control" id="RoleQR" name="RoleQR"> --}}
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Month</label>
                            <input value='{{ $lec->monthly }}' name="Month" class="form-control form-control-lg mt-3"
                                type="text" placeholder="New Password" aria-label=".form-control-sm example">
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Part_Explain</label>
                            <input value='{{ $lec->name0 }}' name="name0" class="form-control form-control-lg mt-3"
                                type="text" placeholder="New Password" aria-label=".form-control-sm example">
                        </div>
                        <div class="mb-3">
                            <label for="RoleQR" class="form-label">Part_Links</label>
                            <input value='{{ $lec->link0 }}' name="link0" class="form-control form-control-lg mt-3"
                                type="text" placeholder="New Password" aria-label=".form-control-sm example">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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
