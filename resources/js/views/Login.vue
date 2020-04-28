<template>
    <div class="container higher-dv">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center"> 
                        <h4 class="p-0 m-0"><b>LOGIN</b></h4> 
                    </div>
                    <div class="card-body pt-5 pb-5">
                        <form method="POST" action="#" @submit.prevent="login">
                           
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"> Email Address </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" 
                                        required autocomplete="email" autofocus placeholder="Email address">
                                    <!-- @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password"
                                        placeholder="Password">
                                    <!-- @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror -->
                                </div>
                            </div> 

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                       Login
                                    </button>

                                    <!-- {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}} -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Login',
}
</script>