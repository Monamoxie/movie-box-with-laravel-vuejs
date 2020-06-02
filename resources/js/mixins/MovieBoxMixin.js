export default {
    mounted() {
        this.processing = true 
        const page = this.$route.params.hasOwnProperty('page') && 
            this.$route.params.page !== '' && 
            typeof parseInt(this.$route.params.page) === 'number' ? this.$route.params.page : 1
        this.$store.dispatch('loadMovies', {
            page
        })
        .then((response) => {   
            this.movies = response.data.data.data
            this.paginationParam = response.data.data
            // remove the data part from the object and leave the remaining as pagination data
            delete this.paginationParam.data
            console.log(this.paginationParam) 
        })
        .catch(error => { 
            this.serverResponse = [{
                'status': 'error',
                'message': 'An error occured. Request was not processed',
                'errors': error.response.data.errors !== null && error.response.data.errors !== undefined ? Object.values(error.response.data.errors) : []
            }]   
        })
        .finally(() => {
            this.processing = false 
        })
    }
} 