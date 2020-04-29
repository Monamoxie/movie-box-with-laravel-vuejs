<template> 
    <div class="container higher-dv pt-3">
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

        <h3 class="text-center mb-2 mt-2"> Add New Movie </h3>
        <!-- @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mt-2">{{ $error }}</div>
            @endforeach
        @endif -->
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Title</i></label>
                <div class="col-md-6">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Country</i></label>
                <div class="col-md-6">
                    <input type="text" name="country" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Genre</i></label>
                <div class="col-md-6">
                    <input type="text" name="genre" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Ticket Price</i></label>
                <div class="col-md-6">
                    <input type="text" name="ticket_price" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Rating</i></label>
                <div class="col-md-6">
                    <select  name="rating" class="form-control">
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
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Description</i></label>
                <div class="col-md-6">
                    <textarea class="form-control mb2" name="description" autofocus></textarea> 
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right"><i>Photo</i></label>
                <div class="col-md-6">
                    <input type="file" class="form-control mb2" name="photo" >
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
    
}
</script>