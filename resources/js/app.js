import { createApp } from "vue";

require("./bootstrap");

import App from "./App.vue";
import axios from "axios";
import router from "./router";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.mount("#app");

function loggedIn() {
  return localStorage.getItem('userToken')
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!loggedIn()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } /*else if(to.matched.some(record => record.meta.guest)){
        if (loggedIn()) {
            next({
              path: '/',
              query: { redirect: to.fullPath }
            })
    }*/ else {
    next() // make sure to always call next()!
  }
})
