import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/pages/Home.vue";

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
    // About page
    /* {
        path: "/about",
        name: "About",
        component: About,
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
    // Login, Children: create
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    {
        path: "/join",
        name: "Join",
        component: Join,
    } */
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
