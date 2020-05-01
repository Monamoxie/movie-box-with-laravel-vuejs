<template>
    <div class="higher-dv">
        <div class="box-jumbotron bg-white ">
            <div class="container">
                <h1 class="text-center">Movie Catalogs</h1>
                <p class="lead text-muted text-center">Something short and sweet about the box</p>
            </div>

            <div class="text-center" v-if="processing">
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
                                {{ error[0] }}
                            </p>
                        </div>
                    </div>
                </div>
            
                <div v-else class="album py-5 bg-light">
                    <div class="container"> 
                        <movie-box :movies="movies" :paginationParam="paginationParam"></movie-box> 
                    </div>
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
    import MovieBox from '../components/MovieBox'
    import MovieBoxMixin from '../mixins/MovieBoxMixin'
    export default {
        name: 'Home',
        components: {
            MovieBox
        },
        mixins: [
            MovieBoxMixin
        ],
        data() {
            return {
                topBannerBackgroundImage: 'background-image:url("' + require('../../images/1.jpeg') + ' ")',
                bottomBannerBackgroundImage: 'background-image: url("' + require('../../images/banner22.jpg') + '")',
                movies: [],
                paginationParam: {},
                serverResponse: {}, 
                processing: false
            } 
        },   
    }
</script>