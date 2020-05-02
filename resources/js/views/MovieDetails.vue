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

                <div v-else class="movie-details">

                    <div v-if="Object.keys(movieDetails).length > 0">
                        
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

                        <div class="row mt-5"> 
                            <MovieComments :movieComments="movieComments"></MovieComments>
                        </div>   

                        <PostComment :movieId="movieDetails.id" @displayNewComment="displayNewComment"></PostComment>
                    </div>

                </div>

            </div>

        </div>

        <ZedBanner></ZedBanner>
        
    </div>
</template>
<script>

import MovieComments from '../components/MovieComments'
import ZedBanner from '../components/ZedBanner'
import PostComment from '../components/PostComment'

export default {
    name: "MovieDetails",
    components: {
        MovieComments,
        ZedBanner,
        PostComment
    },
    data() {
        return {
            processingDetails: false,
            serverResponse: [], 
            movieDetails: {},
            movieComments: [],
        }
    },
    mounted() {
        this.processingDetails = true
        this.$store.dispatch('movieDetails', {
            id: this.$route.params.id
        })
        .then((response) => {     
            this.movieDetails = response.data.data.movie
            this.movieComments = response.data.data.comments
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
    },
    methods: {
        displayNewComment(payload) { 
            this.movieComments.unshift(payload.commentData)
        }
    }
}
</script>