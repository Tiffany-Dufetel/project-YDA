import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Contact from "../pages/Profile.vue";
import Profile from "../pages/Profile.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        /* children: [
            {
                path: "/:userId",
                name: "Home",
                component: Home,
            }
        ] */
    },

    // Profile
    {
        path: "/profile/:id",
        name: "Profile",
        component: Profile,
    },
    // Contact
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    /* 
    // Login, Children: create
    {
        path: "/login",
        name: "Login",
        component: Login
    },*/
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
