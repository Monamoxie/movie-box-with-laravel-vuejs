import Home from '../views/Home'
import MovieDetails from '../views/MovieDetails'
import Movies from '../views/Movies'
import Login from '../views/Login'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/movies/:id/:slug',
        name: 'movieDetails',
        component: MovieDetails,
    },
    {
        path: '/movies',
        name: 'movies',
        component: Movies,
    },
    {
        path: '/movies/:page',
        name: 'moviesPaged',
        component: Movies,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        guard: 'guest'
    }
]

export default routes