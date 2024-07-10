
@extends('layouts.login')

@section('content')

<section style="height: 100%; background-image: url(https://firebasestorage.googleapis.com/v0/b/hms-project-655bb.appspot.com/o/IMG-20230224-WA0017.jpg?alt=media&token=3585443a-f145-4e01-962b-7e9df57bb5d9); width: 100%">
  <div class="container py-5 h-70">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 2rem;" >
          <div class="row g-0"  style="height: 620px">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://puspawisatapgri.sch.id/wp-content/uploads/2023/02/IMG_0280-scaled.jpg"
                alt="login form" class="img-fluid" style="border-radius: 2rem 0 0 2rem; height: 620px" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <div class="d-flex justify-content-between" style="margin-top: -20px">
                    <img src="{{ asset('assets/assets/img/smk-bisa.png') }}" style="width: 30%; height: auto;" alt="SMK Bisa">
                    <img src="{{ asset('assets/assets/img/vokasi-smk-bisa.png') }}" style="width: 30%; height: auto;" alt="Vokasi SMK Bisa">
                </div>
                <form action="/auth/authenticate" method="post" style="margin-top: 10px">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="https://puspawisatapgri.sch.id/wp-content/uploads/2023/02/Logo-Pw-.png" style=" width: 20%; height: auto;" alt="">
                    <span class="h4 fw-bold mb-2">SMK PUSPA WISATA PGRI SERPONG</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login into your account</h5>

                  <div class="form-outline mb-4">
                    <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" value="{{ old ('email')}}" autofocus required>
                    <label class="form-label" for="form2Example17">Email address</label>
                    @if(session()->has('loginError'))
                        <div class="invalid-feedback">
                            {{ session('LoginError') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control form-control-lg" id="password" required>
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
