@extends('layouts/base')

@section('banner')
 
<div class="home-banner">

    <div class="banner-text">
        <div class="container">
            <div class="banner-text-size-w3ls">
                <h3 class="banner-top-text text-uppercase text-white font-weight-bold">
                    latest & exclusive 
                </h3>
                <p class="mt-3 mb-5 banner-para-wthree"><span class="text-white font-weight-bold ">Movie</span> Shows from around the world</p>
                <a href="/movies" class="btn button-style">Explore the Box</a>
            </div>
        </div>
    </div>
     
    <img src="{{ asset('images/look2.png') }}" alt="" class="img-fluid fashion-img">
</div>
 
@endsection


@section('content_area') 
	<div class="content_area text-center">
		<div class="container">
			 
			<div class="header-layer">
				<h3 class="title-wthree mb-2">
                    Introducing the <span class="mt-2 text-uppercase font-weight-bold">Movie Box</span>
                </h3>
                <p class=""> The Netflix of the modern world. </p>
            </div> 
		</div>
    </div> 
    
    <div class="movies_container" id="movies_container">

        <div class="processing-wrap" v-if="processing">
            <vue-simple-spinner></vue-simple-spinner> 
        </div>

        <div class="movies_list" v-else="processing">
            <div class="container"> 
                <div v-html="movies_list"></div> 
            </div>
        </div>

    </div>

    <div class="jumbotron">
        <div class="overlay">
            <div class="container">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">
                    In a land of myth, and a time of magic, the destiny of a great kingdom rests on the shoulders of a young boy. His name....
                    Buhari.
                </p>
                <hr class="my-4">
                <p>It uses utility methods for ensuring and reassuring that nothing I just typed makes any sense. </p>
                <a class="btn btn-primary btn-lg" href="javascript:void(0)" role="button">Learn more</a>
            </div>
        </div>
    </div>
    
@endsection



@section('custom_script')
    <script type="text/javascript" src="{{ asset('js/movies_list.js') }}"></script>    
@endsection

    