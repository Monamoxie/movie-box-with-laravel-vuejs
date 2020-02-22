const movieDetails = new Vue({

  el: "#movie_details",

  data: {
      processing: false,
      details_content: '', 
    
  },
 
  mounted() {
      this.processing = true;
      const slug = this.slugExtractor();
      this.movieDetails(slug);
  },

  methods: {

    slugExtractor() { 
      const path = window.location.pathname;
      return path.split("/").splice(-1,1)[0];
    },

      movieDetails(slug) {
        const self = this; 
        axios.post('/api/v1/movies/details', {
          slug: slug
        })
        .then(function(response){ 
          
          if (response.status !== 200){
            self.details_content = 'An error must have occured. No data was returned';  
          }
          else { 
            self.details_content = response.data.data;  
          }
        })
        .catch(error => {
          console.log(error); 
          $.each(error.response.data['errors'], function(key,valueObj){
            self.details_content += '<p class=""> '+error.response.data['errors'][key][0]+' </p> <hr/>';
          });
        })
        .finally(function(){
          self.processing = false;
        })
      }
  }


});