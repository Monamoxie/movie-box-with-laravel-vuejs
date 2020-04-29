<template> 
    <div class="container higher-dv">
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
        <form method="POST" enctype="multipart/form-data" @submit.prevent="newMovie">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Title</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="title" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Country</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="country" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Genre</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="genre" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Ticket Price</i></label>
                <div class="col-md-6">
                    <input type="text" v-model="ticketPrice" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Rating</i></label>
                <div class="col-md-6">
                    <select v-model="rating" class="form-control">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Review</i></label>
                <div class="col-md-6">
                    <textarea class="form-control mb2" v-model="description" autofocus></textarea> 
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
            title: 'A movie',
            country: 'Nigeria',
            genre: 'action',
            ticketPrice: '2300',
            rating: '2',
            banner: null,
            description: 'A new order of description'
        }
    },
    methods: {
        newMovie() {
            console.log(this.banner)
            
            const formData = new FormData()
            formData.append('banner', this.banner, this.banner.name)

            // axios.post('my-domain.com/file-upload', formData)
            this.$store.dispatch('newMovie', {
                banner: this.banner
            })

            // {
            //     title: this.title,
            //     country: this.country,
            //     genre: this.genre,
            //     ticketPrice: this.ticketPrice,
            //     rating: this.rating,
            //     banner: this.banner,
            //     description: this.description
            // }
        },
        uploadBanner(event) {
            this.banner = event.target.files[0]
        }
    },
    mounted() {
        console.log(this.banner)
    }
}
</script>