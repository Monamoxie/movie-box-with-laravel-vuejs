@extends('layouts.base')

@section('content_area')
<div class="container higher-dv">
    <h3 class="text-center mb-2 mt-2"> New Movie </h3>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger mt-2">{{ $error }}</div>
        @endforeach
    @endif
    <form method="POST" action="/movies/store">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Title</i></label>
            <div class="col-md-6">
                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Country</i></label>
            <div class="col-md-6">
                <input type="text" name="country" value="{{ old('country') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Genre</i></label>
            <div class="col-md-6">
                <input type="text" name="genre" value="{{ old('genre') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Ticket Price</i></label>
            <div class="col-md-6">
                <input type="text" name="ticket_price" value="{{ old('ticket_price') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"><i>Rating</i></label>
            <div class="col-md-6">
                <select  name="rating" class="form-control">
                    <option value="{{ old('rating') }}">{{ old('rating') }}</option>
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
                <textarea class="form-control mb2" name="comment" autofocus> 
                    {{ old('comment') }}
                </textarea>
                 
                 
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
@endsection
