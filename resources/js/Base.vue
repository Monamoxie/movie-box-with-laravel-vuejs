<template>
    <div class="wrapper">
        <header> 
            <nav class="navbar navbar-expand-lg fixed-top flex-md-nowrap navbar-light bg-light shadow ">
            
                <div class="navbar-brand col-sm-3 col-md-3 mr-0">
                    <span class="logo-holder">
                        <a class="navbar-brand" href="/">
                            <img src="../images/logo.png" class="logo" alt="Logo">
                        </a> 
                    </span>
                </div>
                
                <div class="col-sm-9 col-md-9">
                    <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav ml-auto top-nav">
                            <li class="nav-item" :class="this.$route.path === '/' ? 'active' : '' " 
                                @click="$router.push({ name: 'home' })">
                                <span class="nav-link">Home</span>
                            </li>
                            <li class="nav-item" :class="this.$route.name === 'movies' || this.$route.name === 'movieDetails' || this.$route.name === 'moviesPaged' ? 'active' : '' "
                                @click="$router.push({ name: 'movies' })">
                                <span class="nav-link">Movies</span>
                            </li>
                            <li class="nav-item" :class="this.$route.path === '/movie/new' ? 'active' : '' " 
                                @click="$router.push({ name: 'new-movie' })">
                                <span class="nav-link">New Review</span>
                            </li>
                            <li class="nav-item" :class="this.$route.path === '/login' ? 'active' : '' "  v-if="!$store.getters.isLoggedIn"
                                @click="$router.push({ name: 'login' })">
                                <span class="nav-link">Login</span>
                            </li>
                            <li class="nav-item" :class="this.$route.path === '/register' ? 'active' : '' "  v-if="!$store.getters.isLoggedIn"
                                @click="$router.push({ name: 'register' })">
                                <span class="nav-link">Register</span>
                            </li>
                            <li class="nav-item" :class="this.$route.path === '/logout' ? 'active' : '' "  v-if="$store.getters.isLoggedIn "
                                @click="$router.push({ name: 'logout' })">
                                <span class="nav-link">Logout</span>
                            </li> 
                        </ul>
                    </div>
                </div>
                
            </nav>

        </header>

        
        <router-view :key="$route.fullPath"></router-view>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">  &copy; {{ new Date().getFullYear() }} <br/>  Developed by Mona Moxie. </span>
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
 
}
</script>