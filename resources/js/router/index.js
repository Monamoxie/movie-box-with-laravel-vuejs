import Home from '../views/Home'
import MovieDetails from '../views/MovieDetails'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home 
    },
    {
        path: '/movies/:slug',
        name: 'movieDetails',
        component: MovieDetails
    }
]

export default routes