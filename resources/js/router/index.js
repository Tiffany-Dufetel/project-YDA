import { createRouter, createWebHistory } from "vue-router";
import App from "../App.vue";
import Contact from "../pages/Contact.vue";
import AdminHome from "../pages/Admin/AdminHome.vue";

const routes = [
    {
        path: "/",
        name: "App",
        component: App,
    },
    {
        path: "/admin",
        name: "AdminHome",
        component: AdminHome,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
