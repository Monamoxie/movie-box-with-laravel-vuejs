<template>
    <div>
      <div class="landing-banner"  :style="topBannerBackgroundImage ? topBannerBackgroundImage : '' ">
            <div class="banner-overlay">
                <div class="container">
                  <div class="banner-text" > 
                         <div class="header-img-text">
                            <h2> LATEST & EXCLUSIVE </h2> 
                            <p class="mt-3 mb-5 banner-para-wthree"><span class="text-white font-weight-bold ">Movie</span> reviews around the globe</p>
                            <a href="/movies" class="btn btn-outline-primary btn-lg btn-explore">Explore the Box</a>
                        </div>  
                    </div>
                    <img src="../../images/look2.png" alt="" class="banner-overlay-img"> 
                </div>
            </div>
        </div>
 
        <div class="box-jumbotron bg-white">
            <div class="container">
                <h1 class="text-center">Movie Catalogs </h1>
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

        <ZedBanner></ZedBanner>
        
        
    </div>   
</template>
<script>
import MovieBox from '../components/MovieBox'
import MovieBoxMixin from '../mixins/MovieBoxMixin'
import ZedBanner from '../components/ZedBanner'

export default {
    name: 'Home',
    components: {
        MovieBox,
        ZedBanner
    },
    mixins: [
        MovieBoxMixin
    ],
    data() {
        return {
            topBannerBackgroundImage: 'background-image:url("../../images/1.jpeg")',
            bottomBannerBackgroundImage: 'background-image: url("../../images/banner22.jpg")',
            movies: [],
            paginationParam: {},
            serverResponse: [],  
            processing: false
        } 
    }
}
</script>