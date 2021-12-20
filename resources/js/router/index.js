import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Contact from "../pages/Contact.vue";

/** Admin */
import Login from "../pages/Auth/Login.vue";
import ForgottenPassword from "../pages/Auth/ForgottenPassword.vue";
import ModifyPassword from "../pages/Auth/ModifyPassword.vue";
import FirstConnection from "../pages/Auth/Verification/FirstConnection.vue";

/** Admin */
import AdminHome from "../pages/Admin/AdminHome.vue";

/** Catalogue */
import CatalogueList from "../pages/Admin/Products/CatalogueList.vue";
import AddProduct from "../pages/Admin/Products/AddProduct.vue";
import ProductDisplay from "../pages/Admin/Products/ProductDisplay.vue";

/** Companies */
import CompaniesList from "../pages/Companies/CompaniesList.vue";
import AddCompany from "../pages/Companies/AddCompany.vue";
import CompanyDisplay from "../pages/Companies/CompanyDisplay.vue";
import CompanyUpdate from "../pages/Companies/CompanyUpdate.vue";

/** Members */
import MembersList from "../pages/Members/MembersList.vue";
import MemberDisplay from "../pages/Members/MemberDisplay.vue";
import MemberUpdate from "../pages/Members/MemberUpdate.vue";

// Orders - members
import ProductOrder from "../pages/Orders/OrderProduct.vue";
import OrdersList from "../pages/Orders/OrdersList.vue";

/** News */
import NewsList from "../pages/Companies/News/NewsList.vue";
import AddNews from "../pages/Companies/News/AddNews.vue";


const routes = [

        {
                path: "/",
                name: "Home",
                meta: { guest: true },
        },
        {
                path: "/contact",
                name: "Contact",
                component: Contact,
                meta: { guest: true },
        },

        /**
         * AUTH
         */
        {
                path: "/login",
                name: "Login",
                component: Login,
                meta: { guest: true },
        },
        {
                path: "/email-verification",
                name: "FirstConnection",
                component: FirstConnection,
                /* meta: { guest: true }, */
        },
        {
                path: "/forgotten-password",
                name: "ForgottenPassword",
                component: ForgottenPassword,
                /* meta: { guest: true }, */
        },
        {
                path: "/modify-password",
                name: "ModifyPassword",
                component: ModifyPassword,
                /* meta: { guest: true }, */
        },

        /**
         * CATALOGUE
         */

        // View the full catalogue -
        {
                path: "/catalogue",
                name: "adminCatalogue",
                component: CatalogueList,
                meta: { requiresAuth: true },
        },
        // Add a product to the catalogue -
        {
                path: "/add-product",
                name: "adminProductAdd",
                component: AddProduct,
                meta: { requiresAuth: true },
        },
        // View a specific catalogue item -
        {
                path: "/catalogue/:id",
                name: "individualProduct",
                component: ProductDisplay,
                meta: { requiresAuth: true },
        },

        /**
         * COMPANIES
         */

        // The list of companies -
        {
                path: "/entreprises",
                name: "adminCompanies",
                component: CompaniesList,
                meta: { requiresAuth: true },
        },
        // Add a company -
        {
                path: "/add-entreprise",
                name: "adminAddCompany",
                component: AddCompany,
                meta: { requiresAuth: true },
        },
        // View a specific company -
        {
                path: "/company/:id",
                name: "individualCompany",
                component: CompanyDisplay,
                props: true,
                meta: { requiresAuth: true },
        },
        // Update company
        {
            path: "/company/:id/edit",
            name: "companyUpdate",
            component: CompanyUpdate,
            meta: { requiresAuth: true },
        },
        /**
         * MEMBRES
         */

        // The list of members -
        {
            path: "/membres",
            name: "companiesMembers",
            component: MembersList,
            meta: { requiresAuth: true },
        },

        // View a specific member from a company -
        {
            path: "/membre/:id",
            name: "individualMember",
            component: MemberDisplay,
            meta: { requiresAuth: true },
        },
        // Update Member
        {
            path: "/membre/:id/edit",
            name: "membreUpdate",
            component: MemberUpdate,
            meta: { requiresAuth: true },
        },

        /**
         * MEMBER CONNECTED - ORDERS
         */

        // View a specific member from a company -
        {
                path: "/commander",
                name: "productOrder",
                component: ProductOrder,
                meta: { requiresAuth: true },
        },
        {
                path: "/commandes",
                name: "orders",
                component: OrdersList,
                meta: { requiresAuth: true },
        },

        {
                path: "/admin",
                name: "AdminHome",
                component: AdminHome,
                meta: { requiresAuth: true },
        },

        /**
        * NEWS
        */

        // View the full news -
        {
                path: "/news",
                name: "adminNews",
                component: NewsList,
                meta: { requiresAuth: true },
        },
        // Add a news -
        {
                path: "/add-news",
                name: "adminNewsAdd",
                component: AddNews,
                meta: { requiresAuth: true },
        },

];

export default createRouter({
        history: createWebHistory(),
        routes,
});

