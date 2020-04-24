@extends('layouts.base')

@section('content_area') 

    <div>
        
        <div>
            @if(session()->has('danger'))
            <div class="alert alert-danger alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h4 class="alert-heading">Error Message: </h4>
                {!! Session::get('danger') !!}
            </div>
            @elseif(session()->has('success'))
                <div class="alert alert-success alert-dismissible"> 
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h4 class="alert-heading">Congratulations!!!</h4>
                    {!! Session::get('success') !!}
                </div>
            @endif
        </div>

        
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

                @else 
                    <div class="row form-wrapper">
                        <div class="col-md-4 post-comment-title">
                            <h3 class="text-primary">Post a Comment >> </h3>
                        </div>
                        <div class="col-md-8">
                            <form method="POST" action="/movies/comment/store">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right"><i>Comment</i></label>
        
                                    <div class="col-md-6">
                                        <textarea class="form-control mb2" name="comment" autofocus> 
                                            {{ old('comment') }}
                                        </textarea>
                                        <input type="hidden" value="{{ $slug }}" name="slug">
                                         
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger mt-2">{{ $error }}</div>
                                            @endforeach
                                        @endif


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


    