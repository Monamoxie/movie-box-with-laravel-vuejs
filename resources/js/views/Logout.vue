<template>
    <div class="text-center logout-container">
        Please wait...
    </div>
</template>
<script>
export default {
    name: 'Logout',
    mounted() {
        this.$store.dispatch('logout')
        .then((response) => {  
            this.$store.dispatch('unsetUserAccess')
           this.$router.push({
               name: 'home'
           })
        })
        .catch(error => { 
            let errDisplay = ''
            if (error.response.data.errors !== null && error.response.data.errors !== undefined) {
                errDisplay = typeof error.response.data.errors === 'object' ? Object.values(error.response.data.errors) : [error.response.data.errors]
            } 
            else {
                errDisplay = []
            }
            this.serverResponse = [{
                'status': 'error',
                'message': 'An error occured. Request was not processed',
                'errors':  errDisplay
            }]   
        }) 
    }
}
</script>