import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Login from "../pages/Auth/Login.vue";
import Contact from "../pages/Contact.vue";
import AdminHome from "../pages/Admin/AdminHome.vue";
import CompaniesList from "../pages/Companies/CompaniesList.vue";
/* import AdminHome from "../pages/Admin/AdminHome.vue"; */

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    {
        path: "/admin",
        name: "AdminHome",
        component: AdminHome,
        children: [
            {
                path: "companies",
                name: "CompaniesList",
                component: CompaniesList,
            },
        ]
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
