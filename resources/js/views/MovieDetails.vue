<template>
    <div class="movies_container">
        <div class="container text-center">
            <div class="text-center" v-if="processingDetails">
                <div class="lds-ring mt-5">
                    <div></div><div></div><div></div><div></div>
                </div>
                <p class="muted"> Loading...</p>
            </div>

            <div v-else>

                 <div v-if="serverResponse.length > 0">
                    <div class="alert alert-danger alert-dismissible text-center">
                        <h2 class="alert-heading">An error occured</h2>
                        <div v-if="serverResponse[0].errors.length > 0">
                            <p v-for="(error, key) in serverResponse[0].errors" :key="key">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>

                <div v-else class="movie_details">
                    <div class="header-layer">
                        <h3 class="title-wthree mb-2">
                            Movie title <span class="mt-2 text-uppercase font-weight-bold"> {{ movieDetails.title }} </span>
                        </h3>
                        <p class=""> <span class=" font-weight-bold text-primary">A 
                            {{ new Date(movieDetails.release_date).getFullYear() }} blockbuster </span>
                        </p>
                    </div> 
                    <div class="row">
                        <div class="col-md-5 image-wrapper">
                            <img :src="`/storage/uploads/images/${ movieDetails.photo }`" :alt="movieDetails.photo">
                        </div>
                        <div class="col-md-7">
                            <dl class="row">
                                <dt class="col-sm-3">Release Date</dt>
                                <dd class="col-sm-9"> {{ movieDetails.formated_release_date }} </dd>
                            
                                <dt class="col-sm-3">Rating</dt>
                                <dd class="col-sm-9">
                                     <i class="fa fa-star orange" v-for="(rated, index) in movieDetails.rating" :key="index"></i>
                                    <span v-if="5 - movieDetails.rating > 0">
                                        <i class="fa fa-star grey" v-for="(rated, index) in 5 - movieDetails.rating" :key="index"></i>
                                    </span>
                                </dd>
                            
                                <dt class="col-sm-3">Ticket Price</dt>
                                <dd class="col-sm-9"> &#8358; {{ movieDetails.ticket_price }} </dd>
                            
                                <dt class="col-sm-3 text-truncate">Country</dt>
                                <dd class="col-sm-9"> {{ movieDetails.country }} </dd>
                            
                                <dt class="col-sm-3">Genre</dt>
                                <dd class="col-sm-9">
                                    {{ movieDetails.genre }}
                                </dd>

                                <dt class="col-sm-3">Description</dt>
                                <dd class="col-sm-9">
                                    {{ movieDetails.description }}
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <!-- <div class="row mt-5"> 
                        <div class="post-comments-box">
                            <div class="container text-center"> 
                                
                                    <div class="row form-wrapper">
                                        <div class="col-md-4 post-comment-title">
                                            <h3 class="text-primary"> Comments >> </h3>
                                        </div>
                                        <div class="col-md-8">
                                            @if (count($movieDetails->comments) > 0)
                                                @foreach ($movieDetails->comments as $comment)
                                                    <div class="card mb-3">
                                                        
                                                        <div class="card-body"> 
                                                        <p class="card-text text-left">{{ $comment->comment }}</p> 
                                                        
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div> 
                            </div>
                        </div> 
                    </div>        -->
                </div>
            </div>

        </div>


        <div class="jumbotron" :style="bottomBannerBackgroundImage ? bottomBannerBackgroundImage : ''">
            <div class="overlay">
                <div class="container">
                    <h1 class="display-4">Hello, world!</h1>
                    <p class="lead">
                        In a land of myth, and a time of magic, the destiny of a great kingdom rests on the shoulders of a young boy. His name....
                        Merlin.
                    </p>
                    <hr class="my-4">
                    <p> A quote from the drama series Merlin </p>
                    <a class="btn btn-primary btn-lg" href="javascript:void(0)" role="button">Learn more</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "MovieDetails",
    data() {
        return {
            processingDetails: false,
            serverResponse: [], 
            movieDetails: {},
            bottomBannerBackgroundImage: 'background-image: url("' + require('../../images/banner22.jpg') + '")'
        }
    },
    mounted() {
        this.processingDetails = true
        this.$store.dispatch('movieDetails', {
            id: this.$route.params.id
        })
        .then((response) => {    
            this.movieDetails = response.data.data
        })
        .catch(error => { 
            let errDisplay = ''
            if (error.response.data.errors !== null && error.response.data.errors !== undefined) {
                errDisplay = typeof error.response.data.errors === 'object' ? Object.values(error.response.data.errors) : [error.response.data.errors]
            } 
            else {
                errDisplay = []
            }
            this.serverResponse = [{
                'status': 'error',
                'message': 'An error occured. Request was not processed',
                'errors':  errDisplay
            }]   
        })
        .finally(() => {
            this.processingDetails = false  
        })
    }
}
</script>