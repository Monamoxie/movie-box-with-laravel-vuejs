<template>
    <div class="post-comments-box">
        <div class="container text-center"> 

            <div v-if="!$store.getters.isLoggedIn" class="alert alert-danger">
                You need to be logged in to post a comment.
                <p class="mt-2 mb-2">
                    <a class="btn btn-primary text-white" @click="$router.push({ name: 'login' })">Login</a>
                    <a class="btn btn-success text-white"  @click="$router.push({ name: 'register' })">Register</a>
                </p>
            </div>
           
            <div v-else class="row form-wrapper">
                <div class="col-md-4 post-comment-title">
                    <h3 class="text-primary">Post a comment >> </h3>
                </div>
                <div class="col-md-8">
                    <form method="POST" @submit.prevent="postComment">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Comment</i></label>
                            <div class="col-md-6">
                                <textarea class="form-control mb2" name="comment" autofocus required v-model="comment"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-left" v-if="!processing">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mt-2" v-else>
                            <div class="lds-ring col-md-6 offset-md-4">
                                <div></div><div></div><div></div><div></div>
                            </div> 
                        </div>

                        <div v-if="serverResponse.length > 0 && !processing">
                            <div class="alert alert-danger alert-dismissible text-center mt-2">
                                <h4 class="alert-heading">{{ serverResponse[0].message }}</h4>
                                <div v-if="serverResponse[0].errors.length > 0">
                                    <p v-for="(error, key) in serverResponse[0].errors" :key="key">
                                        {{ error[0] }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div> 

        </div>
    </div>
</template>
<script>
export default {
    name: 'PostComment',
    data() {
        return {
            comment: '',
            processing: false,
            serverResponse: [],
            processing: false
        }
    },
    props: {
        movieId: {
            type: String,
            required: true
        }
    },
    methods: {
        postComment() {
            this.processing = true 
            this.$store.dispatch('postComment', {
                comment: this.comment,
                movieId: this.movieId
            })
             .then((response) => {     
                this.$emit('displayNewComment', {
                    commentData: response.data.data
                }) 
            })
            .catch(error => { 
                let errDisplay = ''
                if (error.response.data.errors !== null && error.response.data.errors !== undefined) {
                    errDisplay = typeof error.response.data.errors === 'object' ? Object.values(error.response.data.errors) : [{ 0: error.response.data.errors }]
                } 
                else {
                    errDisplay = []
                }
                this.serverResponse = [{
                    'status': 'error',
                    'message': error.response.data.message,
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