import Home from '../views/Home'
import MovieDetails from '../views/MovieDetails'
import Movies from '../views/Movies'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        // meta: { 
        //     guard: 'guest',
        // },
    },
    {
        path: '/movies/:id/:slug',
        name: 'movieDetails',
        component: MovieDetails,
        // meta: { 
        //     guard: 'guest',
        // },
    },
    {
        path: '/movies',
        name: 'movies',
        component: Movies,
        // meta: { 
        //     guard: 'guest',
        // },
    },
    {
        path: '/movies/:page',
        name: 'moviesPaged',
        component: Movies,
        // meta: { 
        //     guard: 'guest',
        // },
    }
]

export default routes