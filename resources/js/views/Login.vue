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
                                <div class="col-md-6" >
                                    <input type="email" class="form-control" name="email" v-model="email"
                                        required autocomplete="email" autofocus placeholder="Email address" 
                                        v-validate="'required|email'" :class="{ 'is-invalid' : errors.has('email') }">
                                    <span class="text-danger">{{ errors.first('email') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control" required autocomplete="current-password"
                                     v-validate="'required'"  :class="{ 'is-invalid' : errors.has('password') }"  
                                     v-model="password" placeholder="Password"> 
                                     <span class="text-danger">{{ errors.first('password') }}</span>
                                </div>
                            </div> 

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                       Login
                                    </button> 
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
    data() {
        return {
            email: '',
            password: ''
        }
    }, 
     methods: {
       
    }
}
</script>