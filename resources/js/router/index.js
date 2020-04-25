import Home from '../views/Home'
import MovieDetails from '../views/MovieDetails'
import Movies from '../views/Movies'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home 
    },
    {
        path: '/movies/:id/:slug',
        name: 'movieDetails',
        component: MovieDetails
    },
    {
        path: '/movies',
        name: 'movies',
        component: Movies
    }
]

export default routes