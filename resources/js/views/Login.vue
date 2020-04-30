<template>
    <div class="container higher-dv">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                  
                    <div class="card-header text-center"> 
                        <h4 class="p-0 m-0"><b>LOGIN</b></h4> 
                    </div>
                    <div class="card-body pt-5 pb-5">

                        <div v-if="('propsMessage' in this.$route.params) 
                            & this.$route.params.propsMessage !== '' 
                            & serverResponse.length < 1 " class="alert alert-success">
                            <p>{{ this.$route.params.propsMessage }} </p>
                        </div>

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

                        <form method="POST" action="#" @submit.prevent="validateLogin">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"> Email Address </label>
                                <div class="col-md-6" >
                                    <input type="email" class="form-control" name="email" v-model="email"
                                         autocomplete="email" autofocus placeholder="Email address" 
                                        v-validate="'required|email'" :class="{ 'is-invalid' : errors.has('email') }">
                                    <span class="text-danger">{{ errors.first('email') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"> Password </label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control"  autocomplete="current-password"
                                     v-validate="'required'"  :class="{ 'is-invalid' : errors.has('password') }"  
                                     v-model="password" placeholder="Password"> 
                                     <span class="text-danger">{{ errors.first('password') }}</span>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="lds-ring" v-if="processing">
                                        <div></div><div></div><div></div><div></div>
                                    </div> 
                                    <div v-else>
                                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <p> Not yet a member? <a href="#" @click.prevent="$router.push( { name: 'register'} )">Register</a> </p>
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
            password: '',
            processing: false,
            serverResponse: []
        }
    },  
    methods: {
        validateLogin() {
            this.$validator.validateAll().then(result => {
                if(result) {
                    this.login(); 
                }
                return false;
            })
        },
        login() {
            this.processing = true 
            this.$store.dispatch('login', {
                email: this.email,
                password: this.password
            })
            .then((response) => {     
                this.$store.dispatch('setUserAccess', {
                    access_token: response.data.data.access_token
                }) 
                 this.$router.push({ name: 'movies', params: {
                    propsMessage: 'Welcome Back!!! You are logged in'
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
    },
    mounted() {
        console.log()
    }
}
</script>