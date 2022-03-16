@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #508bfc;">
   <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
               <div class="card-body p-5 text-center">
                  <form method="POST" action="{{ route('login') }}">
                     @csrf
                     <h3 class="mb-5">Login</h3>
                     <div class="form-outline mb-4">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					    </div>                           
                     </div>
                     <div class="form-outline mb-4">

                     <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
                     </div>
                     <!-- Checkbox -->
                     <div class="form-check d-flex justify-content-start mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember"> Remember password </label>
                     </div>
                     <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                           {{ __('Forgot Your Password?') }}
                        </a>
                    @endif            
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</section>

@endsection






