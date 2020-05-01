<template>
    <div class="container higher-dv">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center"> 
                        <h4 class="p-0 m-0"><b>REGISTER</b></h4> 
                    </div>
                    <div class="card-body pt-5 pb-5">
                        
                        <div v-if="serverResponse.length > 0">
                            <div class="alert alert-danger alert-dismissible text-center">
                                <h2 class="alert-heading">An error occured</h2>
                                <div v-if="serverResponse[0].errors.length > 0">
                                    <p v-for="(error, key) in serverResponse[0].errors" :key="key">
                                        {{ error[0] }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="#" @submit.prevent="validateRegister">

                             <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"> Name </label>
                                <div class="col-md-6" >
                                    <input type="text" class="form-control" name="name" v-model="name"
                                        autofocus placeholder="Your name" 
                                        v-validate="'required|min:3'" :class="{ 'is-invalid' : errors.has('name') }">
                                    <span class="text-danger">{{ errors.first('name') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"> Email Address </label>
                                <div class="col-md-6" >
                                    <input type="email" class="form-control" name="email" v-model="email"
                                         autocomplete="email" placeholder="Email address" 
                                        v-validate="'required|email'" :class="{ 'is-invalid' : errors.has('email') }">
                                    <span class="text-danger">{{ errors.first('email') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control"  autocomplete="current-password"
                                     v-validate="'required'"  :class="{ 'is-invalid' : errors.has('password') }"  
                                     v-model="password" placeholder="Password"  ref="password"> 
                                     <span class="text-danger">{{ errors.first('password') }}</span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"> Confirm Password </label>
                                <div class="col-md-6">
                                    <input type="password" name="confirm_password" class="form-control"  autocomplete="current-password"
                                     v-validate="'required|confirmed:password'"  :class="{ 'is-invalid' : errors.has('confirm_password') }"  
                                     v-model="confirmPassword" placeholder="Password"  data-vv-as="confirm password"> 
                                     <span class="text-danger">{{ errors.first('confirm_password') }}</span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="lds-ring" v-if="processing">
                                        <div></div><div></div><div></div><div></div>
                                    </div> 
                                    <div v-else>
                                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                    </div>
                                </div>
                            </div>

                              <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <p> Already a member? <a href="#" @click.prevent="$router.push( { name: 'login'} )">Login</a> </p>
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
    name: 'Register',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            processing: false,
            serverResponse: []
        }
    }, 
    methods: {
        validateRegister() {
            this.$validator.validateAll().then(result => {
                if(result) { 
                    this.register(); 
                }
                return false;
            })
        },
        register() {
            this.processing = true 
            this.$store.dispatch('register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirmPassword
            })
            .then((response) => {     
                  this.$router.push({ name: 'login', params: {
                    propsMessage: 'Your registration was successful'
                } })
            })  
            .catch(error => { 
                let errDisplay = []
                if (error.response.data.errors !== null && error.response.data.errors !== undefined) {
                    errDisplay = typeof error.response.data.errors === 'object' ? Object.values(error.response.data.errors) : [{0: error.response.data.errors }]
                }  
                this.serverResponse = [{
                    'status': 'error',
                    'message': 'An error occured. Request was not processed',
                    'errors':  errDisplay
                }]   
            })
            .finally(() => {
                this.processing = false  
            })
        }
    }
}
</script>