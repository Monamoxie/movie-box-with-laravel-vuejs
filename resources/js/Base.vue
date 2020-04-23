<template>
    <div class="wrapper">
        <header> 
            <nav class="navbar navbar-expand-lg fixed-top flex-md-nowrap navbar-light bg-light shadow ">
                <span class="logo-holder float-right">
                    <a class="navbar-brand" href="/">
                        <img src="../images/logo.png" class="logo" alt="Logo">
                    </a> 
                </span>
                    
                <div class="nav justify-content-end menu-nav">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle" aria-controls="navbarNavAltMarkup"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> 
                    <div class="collapse navbar-collapse navbar-toggle" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mx-lg-auto">
                            <li>
                                <a class="nav-link active" href="/">Home</a>
                            </li>
                            <li>
                                <a class="nav-link" href="/movies/create/new">Add Movie</a>
                            </li> 

                            <!-- Authentication Links -->
                            <!-- @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest -->


                        </ul> 
                    </div>
                </div>

            </nav>
        </header>
        <router-view></router-view>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">  &copy; {{ new Date().getFullYear() }} <br/>  All rights reserved. </span>
            </div> 
        </footer>
    </div>    
</template>
<script>
export default {
    name: 'App',
    data() {
        return {
            movies: [],
        }
    },
    methods: {
    
    }
}
</script>