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

    /**
     * CATALOGUE
     */

    // View the full catalogue -
    {
        path: "/catalogue",
        name: "adminCatalogue",
        component: CatalogueList,
    },
    // Add a product to the catalogue -
    {
        path: "/add-product",
        name: "adminProductAdd",
        component: AddProduct,
    },
    // View a specific catalogue item -
    {
        path: "/catalogue/:id",
        name: "individualProduct",
        component: ProductDisplay,
    },

    /**
     * COMPANIES
     */

    // The list of companies -
    {
        path: "/entreprises",
        name: "adminCompanies",
        component: CompaniesList,
    },
    // Add a company -
    {
        path: "/add-entreprise",
        name: "adminAddCompany",
        component: AddCompany,
    },
    // View a specific company -
    {
        path: "/company/:id",
        name: "individualCompany",
        component: CompanyDisplay,
        props: true,
    },

    /**
     * MEMBRES
     */

    // The list of members -
    {
        path: "/membres",
        name: "companiesMembers",
        component: MembersList,
    },
    // Add a member to a company -
    {
        path: "/add-members",
        name: "companiesAddMembers",
        component: AddMembers,
    },
    // View a specific member from a company -
    {
        path: "/userId",
        name: "individualMember",
        component: MemberDisplay,
    },

    /**
     * MEMBER CONNECTED - ORDERS
     */

    // View a specific member from a company -
    {
        path: "/commander",
        name: "productOrder",
        component: ProductOrder,
    },
    {
        path: "/commandes",
        name: "orders",
        component: OrdersList,
    },

    {
        path: "/admin",
        name: "adminHome",
        component: AdminHome,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
