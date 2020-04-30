<template> 
    <div class="container new-movie-container mt-5 pt-5 pb-5">
       
        <h3 class="text-center mb-2 mt-2"> New Movie Review </h3>
      
        <div v-if="serverResponse.length > 0">

           <div v-if="serverResponse[0].status === 'error'">
                <div class="alert alert-danger alert-dismissible text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h2 class="alert-heading">An error occured</h2>
                    <div v-if="serverResponse[0].errors.length > 0">
                        <p v-for="(error, key) in serverResponse[0].errors" :key="key">
                            {{ error[0] }}
                        </p>
                    </div>
                </div>
            </div>

            <div v-if="serverResponse[0].status === 'success'">
                <div class="alert alert-success alert-dismissible text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h2 class="alert-heading"> Congratulations!!! </h2>
                    {{ serverResponse[0].message }}
                </div>
            </div>

        </div>
        
        <form method="POST" enctype="multipart/form-data" @submit.prevent="validateSubmission" 
            v-if="serverResponse.length < 1 || (serverResponse.length > 0 && serverResponse[0].status !== 'success')">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Title</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="title" name="title" class="form-control" 
                     v-validate="'required|min:3'" :class="{ 'is-invalid' : errors.has('title') }">
                    <span class="text-danger">{{ errors.first('title') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Country</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="country" name="country" class="form-control" 
                     v-validate="'required|min:3'" :class="{ 'is-invalid' : errors.has('country') }">
                     <span class="text-danger">{{ errors.first('country') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Genre</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="genre" name="genre" class="form-control"
                    v-validate="'required'" :class="{ 'is-invalid' : errors.has('genre') }">
                    <span class="text-danger">{{ errors.first('genre') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Ticket Price</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="ticketPrice" name="ticket_price" class="form-control"
                    v-validate="'required|decimal:2'" :class="{ 'is-invalid' : errors.has('ticket_price') }" data-vv-as="ticket price">
                    <span class="text-danger">{{ errors.first('ticket_price') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Rating</i></label>
                <div class="col-md-6">
                    <select v-model="rating" name="rating" class="form-control" 
                    v-validate="'required'" :class="{ 'is-invalid' : errors.has('rating') }">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                     <span class="text-danger">{{ errors.first('rating') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Review</i></label>
                <div class="col-md-6">
                    <textarea class="form-control mb2" v-model="description" name="description" rows="5"
                    v-validate="'required'" :class="{ 'is-invalid' : errors.has('description') }"></textarea> 
                    <span class="text-danger">{{ errors.first('description') }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Photo</i></label>
                <div class="col-md-6">
                    <input type="file" name="banner" class="form-control mb2"  accept="image/*" @change="uploadBanner($event)"
                        v-validate="'required|image|mimes:image/*|size:2048'" :class="{ 'is-invalid' : errors.has('banner') }">
                        <span class="text-danger">{{ errors.first('banner') }}</span>
                </div>
            </div>

            <div class="form-group row mb-0" v-if="!processing">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>

            <div class="form-group row mt-0" v-else>
                <div class="col-md-6 offset-md-4">
                    <div class="lds-ring">
                        <div></div><div></div><div></div><div></div>
                    </div> 
                </div>
            </div>

            

        </form>
    </div> 
</template>
<script>
export default {
    name: 'NewMovie',
    data() {
        return {
            title: '',
            country: '',
            genre: '',
            ticketPrice: '',
            rating: '',
            banner: null,
            description: '',
            processing: false,
            serverResponse: []
        }
    },
    methods: {
         validateSubmission() {
            this.$validator.validateAll().then(result => {
                if(result) { 
                    this.newMovie();  
                }
                return false;
            })
        },
        newMovie() {
            this.processing = true 
            const formData = new FormData()
            formData.append('title', this.title)
            formData.append('country', this.country)
            formData.append('genre', this.genre)
            formData.append('ticket_price', this.ticketPrice)
            formData.append('rating', this.rating)
            formData.append('description', this.description)
            formData.append('photo', this.banner, this.banner.name)
 
            this.$store.dispatch('newMovie', formData) 
            .then((response) => {     
                 this.serverResponse = [{
                    'status': 'success',
                    'message': response.data.message,
                    'errors':  []
                }] 
                
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
                    'message': error.response.data.message,
                    'errors':  errDisplay
                }]   
            })
            .finally(() => {
                this.processing = false  
            })
        },
        uploadBanner(event) {
            this.banner = event.target.files[0]
        }
    } 
}
</script>