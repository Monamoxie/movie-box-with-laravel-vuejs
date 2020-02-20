new Vue({
    el: "#movies_container",

    data: {
        processing: false,
    },

    mounted() {
        this.processing = true;
        this.loadMovies();
    },

    methods: {
        loadMovies() {
            axios
          .post('/api/v1/movies/list', {
            access_id: self.access_id,
            access_password: self.access_password, 
          })
          .then(function(response){ 
            if (response.data.json_code !== 1)
            {
              self.message = response.data.json_message; 
              self.is_error_response = true;
            }
            else 
            { 
              self.message =  ( response.data.json_message.user_type === "" ) ? 'Welcome home' : 'Welcome back ' + response.data.json_message.first_name; 
              self.is_success_response = true; 
              window.location.href = '/' + response.data.json_message.user_type;
            }
            
          })
          .catch(error => {
            console.log(error) 
          })
          .finally(function(){
            self.processing = false;
          })
        }
    }


});