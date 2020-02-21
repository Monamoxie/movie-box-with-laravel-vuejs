<div class="movie_details">
    <div class="header-layer">
        <h3 class="title-wthree mb-2">
            Movie title <span class="mt-2 text-uppercase font-weight-bold"> {{ $movieDetails->title }} </span>
        </h3>
        <p class=""> <span class=" font-weight-bold text-primary">A {{ date('Y', strtotime($movieDetails->release_date)) }} blockbuster </span></p>
    </div> 
    <div class="row">
        <div class="col-md-5 image-wrapper">
            <img src="{{ asset('uploads/images/'.$movieDetails->photo) }}">
        </div>
        <div class="col-md-7">
            <dl class="row">
                <dt class="col-sm-3">Release Date</dt>
                <dd class="col-sm-9"> {{ $movieDetails->release_date }} </dd>
              
                <dt class="col-sm-3">Rating</dt>
                <dd class="col-sm-9">
                    @for ($ratingScore = 1; $ratingScore <= $movieDetails->rating; $ratingScore++)
                    <i class="fa fa-star orange"></i> 
                 @endfor

                 @if ( (5 - (int) $movieDetails->rating) > 0)
                     @for ($ratingScore = 1; $ratingScore <= 5 - $movieDetails->rating; $ratingScore++)
                         <i class="fa fa-star grey"></i> 
                     @endfor
                 @endif
                </dd>
              
                <dt class="col-sm-3">Ticket Price</dt>
                <dd class="col-sm-9"> &#8358; {{ $movieDetails->ticket_price }} </dd>
              
                <dt class="col-sm-3 text-truncate">Country</dt>
                <dd class="col-sm-9"> {{ $movieDetails->country }} </dd>
              
                <dt class="col-sm-3">Genre</dt>
                <dd class="col-sm-9">
                    {{ $movieDetails->genre }}
                </dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">
                    {{ $movieDetails->description }}
                </dd>
              </dl>
        </div>
    </div>

    
</div>
