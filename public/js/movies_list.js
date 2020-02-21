const movieList = new Vue({
    el: "#movies_container",

    data: {
        processing: false,
        movies_list: ''
    },

    mounted() {
        this.processing = true;
        this.loadMovies();
    },

    methods: {
        loadMovies() {
          const self = this;

          axios.post('/api/v1/movies/list')
          .then(function(response){ 
            
            if (response.status !== 200){
              self.movies_list = 'An error must have occured';  
            }
            else { 
              console.log(response.data.data);
              self.movies_list = response.data.data;  
            }
          })
          .catch(error => {
            console.log(error);
            self.movies_list = 'An unknown error must have occured.';  
          })
          .finally(function(){
            self.processing = false;
          })
        }
    }


});




 