<template>
    <div>
      <div class="landing-banner"  :style="backgroundImage ? backgroundImage : '' ">
            <div class="banner-overlay">
                <div class="container">
                  <div class="banner-text" > 
                         <div class="header-img-text">
                            <h2> LATEST & EXCLUSIVE </h2> 
                            <p class="mt-3 mb-5 banner-para-wthree"><span class="text-white font-weight-bold ">Movie</span> Shows from around the world</p>
                            <a href="/movies" class="btn button-style">Explore the Box</a>
                        </div>  
                    </div>
                    <img src="../../images/look2.png" alt="" class="banner-overlay-img"> 
                </div>
            </div>
        </div> 

        <section class="box-jumbotron bg-white">
            <div class="container">
                <h1 class="text-center">Movie Catalogs </h1>
                <p class="lead text-muted text-center">Something short and sweet about the box</p>
            </div>
            
            <div class="album py-5 bg-light" style="display:none">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        
    </div>   
</template>
<script>
export default {
    name: 'Home',
    data() {
        return {
            backgroundImage: 'background-image:url("' + require('../../images/1.jpeg') + ' ")'
        }
    },
    mounted() {
        
    }
}
</script>