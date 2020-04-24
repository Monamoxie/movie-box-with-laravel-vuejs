<template> 
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <img class="card-img-top" :src="photoPath(movie.photo)" alt="Card image cap" @click="movieDetails(movie.slug)">
            <div class="card-body">
                <h4> {{ movie.title }} </h4>
                <p class="card-text">  
                    {{ movie.description.length > 100 ? movie.description.substring(0, 100) + '...' : movie.description }} 
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    
                    <span>
                        <i class="fa fa-star orange" v-for="(rated, index) in parseInt(movie.rating)" :key="index"></i>
                        <span v-if="5 - parseInt(movie.rating) > 0">
                            <i class="fa fa-star grey" v-for="(rated, index) in 5 - parseInt(movie.rating)" :key="index"></i>
                        </span>
                    </span> 
                    <small class="text-muted"></small>
                </div>
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
         movieDetails(slug) {
            this.$router.push({
                name: 'movieDetails',
                params: {
                    slug: slug
                },
            }) 
        }
    },
    props: {
        movie: {
            type: Object,
            required: true
        }
    },
}
</script>