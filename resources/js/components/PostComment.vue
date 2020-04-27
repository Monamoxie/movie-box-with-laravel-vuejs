<template>
    <div class="post-comments-box">
        <div class="container text-center"> 

            <div v-if="!$store.getters.isLoggedIn" class="alert alert-danger">
                You need to be logged in to post a comment.
                <p class="mt-2 mb-2">
                    <a class="btn btn-primary" href="/login">Login</a>
                    <a class="btn btn-success" href="/register">Register</a>
                </p>
            </div>

            <div v-else class="row form-wrapper">
                <div class="col-md-4 post-comment-title">
                    <h3 class="text-primary">Post a Comment >> </h3>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="/movies/comment/store">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Comment</i></label>

                            <div class="col-md-6">
                                <textarea class="form-control mb2" name="comment" autofocus> 
                                    <!-- {{ old('comment') }} -->
                                </textarea>
                                <input type="hidden" value="" name="slug">
                                
                                <!-- @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger mt-2">{{ $error }}</div>
                                    @endforeach
                                @endif -->


                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
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
    props: {
        movieId: {
            type: String,
            required: true
        }
    },
    mounted() {
        console.log(this.movieId)
    }
}
</script>