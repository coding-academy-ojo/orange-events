<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Login</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="{{ asset('assets/brand/orange-logo.svg') }}" rel="icon">
<link href="{{ asset('dashboard') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link
  href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
  rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('dashboard') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="{{ asset('dashboard') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset('dashboard') }}/assets/css/style.css" rel="stylesheet">

<body>



  <main>
    <div class="container">

      <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-2">

                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/brand/orange-is-here-black.svg') }}" alt="" class="img-is-here">
                  <span class="d-none d-lg-block">
                    <img src="" width="" alt="">
                  </span>

                </a>
              </div><!-- End Logo -->

              @session('status')
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endsession

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                  <form action="{{ route('login') }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="yourUsername"
                          value="{{ old('email') }}" require>
                      </div>
                      @error('email')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" require>
                      @error('password')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-12">
                      <a class="forget-password-link" href="{{ route('password.request') }}">Forget Password ?</a>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-orange-main w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>



</body>

</html>