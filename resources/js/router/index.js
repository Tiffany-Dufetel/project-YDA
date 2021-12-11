import { createRouter, createWebHistory } from "vue-router";

import Home from "../pages/Home.vue";
import Login from "../pages/Auth/Login.vue";
import Contact from "../pages/Contact.vue";
import AdminHome from "../pages/Admin/AdminHome.vue";
import CompaniesList from "../pages/Companies/CompaniesList.vue";
import CatalogueList from "../pages/Admin/Products/CatalogueList.vue";
import MembersList from "../pages/Members/MembersList.vue";
import AddCompany from "../pages/Companies/AddCompany.vue";
import AddProduct from "../pages/Admin/Products/AddProduct.vue";
import AddMembers from "../pages/Members/AddMembers.vue";
import CompanyDisplay from "../pages/Companies/CompanyDisplay.vue";
import MemberDisplay from "../pages/Members/MemberDisplay.vue";
import ProductDisplay from "../pages/Admin/Products/ProductDisplay.vue";

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
    // NEEDS TO BE ROUTE CHILDREN FROM ADMIN
    {
        path: "/catalogue",
        name: "adminCatalogue",
        component: CatalogueList,
    },
    // Add a product to the catalogue -
    // NEEDS TO BE ROUTE CHILDREN FROM ADMIN/CATALOGUE
    {
        path: "/add-product",
        name: "adminProductAdd",
        component: AddProduct,
    },
    // View a specific catalogue item -
    // NEEDS TO BE ROUTE CHILDREN FROM ADMIN/CATALOGUE/id
    {
        path: "/productId",
        name: "individualProduct",
        component: ProductDisplay,
    },

    /**
     * COMPANIES
     */

    // The list of companies -
    // NEEDS TO BE ROUTE CHILDREN FROM ADMIN/ENTREPRISES
    {
        path: "/entreprises",
        name: "adminCompanies",
        component: CompaniesList,
    },
    // Add a company -
    // NEEDS TO BE ROUTE CHILDREN FROM ADMIN/ENTREPRISES
    {
        path: "/add-entreprise",
        name: "adminAddCompany",
        component: AddCompany,
    },
    // View a specific company -
    // NEEDS TO BE ROUTE CHILDREN FROM ENTREPRISES/MEMBRES/userid
    {
        path: "/companyId",
        name: "individualCompany",
        component: CompanyDisplay,
    },

    /**
     * MEMBRES
     */

    // The list of members -
    // NEEDS TO BE ROUTE CHILDREN FROM ENTREPRISES
    {
        path: "/membres",
        name: "companiesMembers",
        component: MembersList,
    },
    // Add a member to a company -
    // NEEDS TO BE ROUTE CHILDREN FROM ENTREPRISES/MEMBRES
    {
        path: "/add-members",
        name: "companiesAddMembers",
        component: AddMembers,
    },
    // View a specific member from a company -
    // NEEDS TO BE ROUTE CHILDREN FROM ENTREPRISES/MEMBRES/userid
    {
        path: "/userId",
        name: "individualMember",
        component: MemberDisplay,
    },


    {
        path: "/admin",
        name: "adminHome",
        component: AdminHome,
        /* children: [
            {
                path: "entreprises",
                name: "adminCompanies",
                component: CompaniesList,
                children: [
                    {
                        path: "add",
                        name: "adminAddCompany",
                        component: AddCompany,
                    },
                ]
            },
            {
                path: "catalogue",
                name: "adminCatalogue",
                component: CatalogueList,
                children: [
                    {
                        path: "add",
                        name: "adminProductAdd",
                        component: AddProduct,
                    },
                ]
            },
        ] */
    },

];

export default createRouter({
    history: createWebHistory(),
    routes,
});
