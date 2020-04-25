<template> 
    <div class="row">
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
        <div class="col-md-12 col-sm-12 mt-4 mb-4 p-3 text-center">
            <div v-if="this.$route.path === '/'">
                <button type="button" class="btn btn-primary btn-lg">View All</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "MovieBox",
    
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
        }
    },
    props: {
        movies: {
            type: Array,
            required: true
        }
    },
}
</script>