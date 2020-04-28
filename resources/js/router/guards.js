module.exports = (router, store) => {
    router.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.guard === 'auth:api')) { 
          if (!store.getters.isLoggedIn) {
            next({
              name: 'login',
              query: { redirect: to.fullPath }
            })
          } else {
            next()
          }
        }
        else if (to.matched.some(record => record.meta.guard === 'guest')) { 
          if (store.getters.isLoggedIn) {
            next({
              name: 'movies'
            })
          } else {
            next()
          }
        }
        else {
          next() // make sure to always call next()!
        }
    })
}