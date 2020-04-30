<template> 
    <div class="container mt-5 pt-5 pb-5">
        <!-- @if(session()->has('danger'))
        <div class="alert alert-danger alert-dismissible text-center"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h4 class="alert-heading">Error Message: </h4>
            {!! Session::get('danger') !!}
        </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible text-center"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4 class="alert-heading">Congratulations!!!</h4>
                {!! Session::get('success') !!}
            </div>
        @endif -->

        <h3 class="text-center mb-2 mt-2"> New Movie Review </h3>
        <!-- @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-2">{{ $error }}</div>
            @endforeach
        @endif -->
        <form method="POST" enctype="multipart/form-data" @submit.prevent="validateSubmission">
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
                    v-validate="'required'" :class="{ 'is-invalid' : errors.has('ticket_price') }">
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
                    <input type="file" class="form-control mb2" 
                        accept="image/*" @change="uploadBanner($event)">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
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
            country: 'Nigeria',
            genre: 'action',
            ticketPrice: '2300',
            rating: '22',
            banner: null,
            description: 'A new order of description'
        }
    },
    methods: {
         validateSubmission() {
            this.$validator.validateAll().then(result => {
                if(result) { 
                    // this.newMovie(); 
                    alert('all set');
                }
                return false;
            })
        },
        newMovie() {
             
            const formData = new FormData()
            formData.append('title', this.title)
            formData.append('country', this.country)
            formData.append('genre', this.genre)
            formData.append('ticketPrice', this.ticketPrice)
            formData.append('rating', this.rating)
            formData.append('description', this.description)
            formData.append('banner', this.banner, this.banner.name)
 
            this.$store.dispatch('newMovie', formData) 
        },
        uploadBanner(event) {
            this.banner = event.target.files[0]
        }
    } 
}
</script>