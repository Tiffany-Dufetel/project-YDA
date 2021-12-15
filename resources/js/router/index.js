import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Login from "../pages/Auth/Login.vue";
import Contact from "../pages/Contact.vue";

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

/** Members */
import MembersList from "../pages/Members/MembersList.vue";
import AddMembers from "../pages/Members/AddMembers.vue";
import MemberDisplay from "../pages/Members/MemberDisplay.vue";

// Orders - members
import ProductOrder from "../pages/Orders/OrderProduct.vue";
import OrdersList from "../pages/Orders/OrdersList.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
        meta: { guest: true }
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: { guest: true }
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
        meta: { guest: true }
    },

    /**
     * CATALOGUE
     */

    // View the full catalogue -
    {
        path: "/catalogue",
        name: "adminCatalogue",
        component: CatalogueList,
        meta: { requiresAuth: true }

    },
    // Add a product to the catalogue -
    {
        path: "/add-product",
        name: "adminProductAdd",
        component: AddProduct,
        meta: { requiresAuth: true }

    },
    // View a specific catalogue item -
    {
        path: "/catalogue/:id",
        name: "individualProduct",
        component: ProductDisplay,
        meta: { requiresAuth: true }

    },

    /**
     * COMPANIES
     */

    // The list of companies -
    {
        path: "/entreprises",
        name: "adminCompanies",
        component: CompaniesList,
        meta: { requiresAuth: true }

    },
    // Add a company -
    {
        path: "/add-entreprise",
        name: "adminAddCompany",
        component: AddCompany,
        meta: { requiresAuth: true }
    },
    // View a specific company -
    {
        path: "/company/:id",
        name: "individualCompany",
        component: CompanyDisplay,
        meta: { requiresAuth: true }

    },

    /**
     * MEMBRES
     */

    // The list of members -
    {
        path: "/membres",
        name: "companiesMembers",
        component: MembersList,
        meta: { requiresAuth: true }

    },
    // Add a member to a company -
    {
        path: "/add-members",
        name: "companiesAddMembers",
        component: AddMembers,
        meta: { requiresAuth: true }

    },
    // View a specific member from a company -
    {
        path: "/membre/:id",
        name: "individualMember",
        component: MemberDisplay,
        meta: { requiresAuth: true }

    },

    /**
     * MEMBER CONNECTED - ORDERS
     */

    // View a specific member from a company -
    {
        path: "/commander",
        name: "productOrder",
        component: ProductOrder,
        meta: { requiresAuth: true }

    },
    {
        path: "/commandes",
        name: "orders",
        component: OrdersList,
        meta: { requiresAuth: true }

    },

    {
        path: "/admin",
        name: "adminHome",
        component: AdminHome,
        meta: { requiresAuth: true }

    },

];

export default createRouter({
    history: createWebHistory(),
    routes,
});
