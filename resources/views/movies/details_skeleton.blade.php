@extends('layouts.base')

@section('content_area') 
    <div class="movies_container" id="movie_details">

        <div class="processing-wrap" v-if="processing">
            <vue-simple-spinner></vue-simple-spinner> 
        </div>

        <div v-else="processing">
            <div class="container"> 
                <div v-html="details_content"></div> 
            </div>
        </div>

        <div class="post-comments-box">
            <div class="container text-center"> 
                @if ($userStatus === false)
                    <div class="alert alert-danger">
                        You need to be logged in to post a comment.
                        <p class="mt-2 mb-2">
                            <a class="btn btn-primary" href="/login">Login</a>
                            <a class="btn btn-success" href="/register">Register</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="jumbotron">
            <div class="overlay">
                <div class="container">
                    <h1 class="display-4">Hello, world!</h1>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('custom_script')
    <script type="text/javascript" src="{{ asset('js/movie_details.js') }}"></script>    
@endsection


    