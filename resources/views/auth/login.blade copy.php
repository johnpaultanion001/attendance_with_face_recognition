@extends('../layouts.resident')
@section('sub-title','LOG IN')

@section('navbar')
    @include('../partials.resident.navbar')
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<main id="main">
  <section class="contact mt-5 section-bg" style="min-height: 80vh;">
    <div class="container">
        <div class="section-title" data-aos="zoom-out">
          <h2>Log in</h2>
          <p>Login to your account</p>
        </div>
        <div class="row mt-2">
          <div class="col-lg-6 mt-lg-0 mx-auto" data-aos="fade-left">
            <form method="POST" action="{{ route('login') }}" class="myform">  
              @csrf
                
                <div class="card">
                  <div class="text-center mt-2">
                      <img  src="{{ trans('panel.logo') }}" alt="logo"  class="z-depth-2">
                      <hr>
                  </div>
                  <div class="card-body">
                    <div class="row">
                          <div class="form-group">
                              <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"  aria-label="Email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          <div class="form-group">
                              <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password">
                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="mt-2">Log In</button>
                      </div>
                      <p class="text-center mt-3 color-black" style="font-size: 15px; font-weight: 500;">Do not have an account yet? <a href="/register"><b class="color-black" style="font-weight: 700">Register here</b></a></p>
                      <p  class="text-center mt-3 color-black" style="font-size: 15px; font-weight: 500;" ><a href="/password/reset">Forgot your password?</a></p>
                  </div>
                </div>
            </form>
            
            
          </div>
        </div>
    </div>
  </section>
</main>
@endsection

@section('footer')
    @include('../partials.resident.footer')
@endsection

@section('script')
<script> 

</script>
@endsection
