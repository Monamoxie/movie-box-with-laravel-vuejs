<template>
    <div class="post-comments-box">
        <div class="container text-center"> 
                <div class="row form-wrapper">
                    <div class="col-md-4 post-comment-title">
                        <h3 class="text-primary"> Comments >> </h3>
                    </div>
                    <div class="col-md-8">
                        <div v-if="movieComments.length > 0"> 
                            <div class="card mb-3" v-for="(comment, key) in movieComments" :key="key">
                                    <div class="card-body"> 
                                        <p class="card-text text-left">{{ comment.comment }}</p> 
                                    </div>
                                    <div class="card-footer text-muted"> 
                                        <div class=" float-left"> {{ comment.formatted_created_at }}</div>
                                        <div class=" float-right"> {{ comment.poster_name }}</div>
                                    </div>
                            </div>
                        </div> 
                        <div v-else class="alert alert-warning">
                            No comment yet. Be the first.
                        </div>  
                    </div>
                </div> 
        </div>
    </div> 
</template>
<script>
export default {
    name: 'MovieComments',
    props: {
        movieComments: {
            type: Array,
            require: true
        }
    }

}
</script>