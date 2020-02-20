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
     
    <img src="images/look2.png" alt="" class="img-fluid fashion-img">
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
@endsection