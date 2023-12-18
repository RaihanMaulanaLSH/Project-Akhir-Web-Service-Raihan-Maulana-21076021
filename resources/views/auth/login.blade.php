<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Page</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('skydash/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('skydash//vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('skydash/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('skydash//css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="skydash/images/green.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <center>
              <div class="brand-logo">
                <img src="skydash/images/green.png" alt="logo">
              </div>
                </center>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Log in untuk melanjutkan</h6>
              <form class="pt-3" action="{{ route('login-proses')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                @error('email')
                    <small>{{$message}}</small>
                @enderror
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                @error('password')
                    <small>{{$message}}</small>
                @enderror
                <div class="mt-3">
                    <!-- Mengganti <a> dengan <button> -->
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOG IN</button>
                </div>
                {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me Login in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> --}}
                {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> --}}
                {{-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="{{ route('register')}}" class="text-primary">Create</a>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('skydash/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('skydash/js/off-canvas.js')}}"></script>
  <script src="{{ asset('skydash/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('skydash/js/template.js')}}"></script>
  <script src="{{ asset('skydash/js/settings.js')}}"></script>
  <script src="{{ asset('skydash/js/todolist.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  @if($message = Session::get('login gagal'))
        <script>
            Swal.fire('{{$message}}');
        </script>
    @endif

    @if($message = Session::get('succes'))
        <script>
            Swal.fire('{{$message}}');
        </script>
    @endif
  <!-- endinject -->
</body>

</html>
