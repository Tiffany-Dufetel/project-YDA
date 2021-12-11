import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Login from "../pages/Auth/Login.vue";
import Contact from "../pages/Contact.vue";
import AdminHome from "../pages/Admin/AdminHome.vue";
import CompaniesList from "../pages/Companies/CompaniesList.vue";
import CatalogueList from "../pages/Admin/Products/CatalogueList.vue";
import AddCompany from "../pages/Companies/AddCompany.vue";
import AddProduct from "../pages/Admin/Products/AddProduct.vue";
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
                path: "/entreprises",
                name: "CompaniesList",
                component: CompaniesList,
                children: [
                    {
                        path: "/add",
                        name: "AddCompany",
                        component: AddCompany,
                    },
                ]
            },
            {
                path: "/catalogue",
                name: "CatalogueList",
                component: CatalogueList,
                children: [
                    {
                        path: "/add",
                        name: "AddProduct",
                        component: AddProduct,
                    },
                ]
            },
        ]
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
