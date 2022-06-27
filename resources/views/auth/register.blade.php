<!--
=========================================================
* Soft UI Dashboard - v1.0.6
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    wa - api
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('soft-ui/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('soft-ui/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('soft-ui/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('soft-ui/assets/css/soft-ui-dashboard.css?v=1.0.6') }}" rel="stylesheet" />
</head>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column m-auto">
              <div class="card card-plain mt-8">

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="text-white">{{ session('error') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              @endif

              @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <span class="text-white">{{ session('success') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              @endif

                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang Halaman Pendaftaran</h3>
                  {{-- <p class="mb-0">Silahka masukkan email dan password anda</p> --}}
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('register-process') }}">
                    @csrf

                    <div>
                      <label>Nama</label>
                      <div class="mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-label="name" aria-describedby="email-addon">
                      </div>
                      @error('name')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                      @enderror
                    </div>
                    
                    <div>
                      <label>No Telepon</label>
                      <div class="mb-3">
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="" aria-label="phone" aria-describedby="email-addon">
                      </div>
                      @error('phone_number')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                      @enderror
                    </div>

                    <div>
                      <label>Email</label>
                      <div class="mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" aria-label="Email" aria-describedby="email-addon">
                      </div>
                      @error('email')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                      @enderror
                    </div>

                    <div>
                      <label>Password</label>
                      <div class="mb-3">
                        <input type="password" name="password_decrypt" class="form-control @error('password_decrypt') is-invalid @enderror" placeholder="" aria-label="Password" aria-describedby="password-addon">
                      </div>
                      @error('password_decrypt')
                        <span class="text-danger"><i>{{ $message }}</i></span>
                      @enderror
                    </div>
         
                    <div class="text-center">
                      <button class="btn bg-gradient-info w-100 mt-4 mb-0">Daftar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ asset('sft-ui/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('sft-ui/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('sft-ui/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('sft-ui/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('sft-ui/assets/js/soft-ui-dashboard.min.js?v=1.0.6') }}"></script>
</body>

</html>