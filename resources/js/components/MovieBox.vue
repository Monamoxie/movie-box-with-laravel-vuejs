<template> 
    <div>

        <div v-if="movies.length < 1" class="text-center">
            <div class="alert alert-danger">
                No record found
            </div>
        </div>

        <div class="row" v-else> 
            <div class="col-md-4"  v-for="(movie, key) in movies" :key="key">
                <div class="card mb-4 shadow-sm">
                    <img class="card-img-top" :src="photoPath(movie.photo)" alt="Card image cap" @click="movieDetails(movie.id, movie.slug)">
                    <div class="card-body">
                        <h4> {{ movie.title }} </h4>
                        <p class="card-text">  
                            {{ movie.description.length > 100 ? movie.description.substring(0, 100) + '...' : movie.description }} 
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            
                            <span>
                                <i class="fa fa-star orange" v-for="(rated, index) in movie.rating" :key="index"></i>
                                <span v-if="5 - movie.rating > 0">
                                    <i class="fa fa-star grey" v-for="(rated, index) in 5 - movie.rating" :key="index"></i>
                                </span>
                            </span> 
                            <small class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="col-mg-12 col-md-12 mt-4 mb-4 p-3 text-center">
               
                <div v-if="this.$route.path === '/'" >
                     <button type="button" class="btn btn-primary btn-lg" @click="$router.push({ name: 'movies' })">View All</button>
                </div>
               
                <div class="mt-2 " v-else>
                    <pagination :paginationParam="paginationParam"></pagination>
                </div>  
            </div> 
        </div>
        
        
        
    </div>
</template>
<script>
import Pagination from './Pagination'

export default {
    name: "MovieBox",
    components: {
        Pagination
    },
    methods: {
        photoPath(photo) {
            return '/storage/uploads/images/' + photo 
        },
         movieDetails(id, slug) {
            this.$router.push({
                name: 'movieDetails',
                params: {
                    id,
                    slug
                },
            }) 
        },
    },
    props: {
        movies: {
            type: Array,
            required: true
        },
        paginationParam: {
            type: Object,
            required: true
        }
    }, 
}
</script>