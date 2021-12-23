import { createRouter, createWebHistory, routerKey } from "vue-router";

import Home from "../pages/Home.vue";

/** Admin */
import Login from "../pages/Auth/Login.vue";
import ForgottenPassword from "../pages/Auth/ForgottenPassword.vue";
import ModifyPassword from "../pages/Auth/ModifyPassword.vue";
import FirstConnection from "../pages/Auth/Verification/FirstConnection.vue";
import MembersList from "../pages/Admin/MembersList.vue";

/** Admin */
import ConnectedHome from "../pages/ConnectedHome.vue";

/** Catalogue */
import CatalogueList from "../pages/Admin/Products/CatalogueList.vue";
import AddProduct from "../pages/Admin/Products/AddProduct.vue";
import ProductDisplay from "../pages/Admin/Products/ProductDisplay.vue";
import ProductUpdate from "../pages/Admin/Products/ProductUpdate.vue";

/** Companies */
import CompaniesList from "../pages/Companies/CompaniesList.vue";
import AddCompany from "../pages/Companies/AddCompany.vue";
import CompanyDisplay from "../pages/Companies/CompanyDisplay.vue";
import CompanyUpdate from "../pages/Companies/CompanyUpdate.vue";

/** Members */
import MemberDisplay from "../pages/Members/MemberDisplay.vue";
import MemberUpdate from "../pages/Members/MemberUpdate.vue";

// Orders - members
import ProductOrder from "../pages/Orders/OrderProduct.vue";
import OrderUpdate from "../pages/Orders/OrderUpdate.vue";
import OrdersList from "../pages/Orders/OrdersList.vue";

/** News */
import NewsList from "../pages/Companies/News/NewsList.vue";
import AddNews from "../pages/Companies/News/AddNews.vue";


const routes = [

        {
                path: "/",
                name: "Home",
                component: Home,
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
                path: "/verification",
                name: "FirstConnection",
                component: FirstConnection,
                /* meta: { guest: true }, */
        },
        {
                path: "/password-oublier",
                name: "ForgottenPassword",
                component: ForgottenPassword,
                /* meta: { guest: true }, */
        },
        {
                path: "/modifier-password/:id/:hash",
                name: "ModifyPassword",
                component: ModifyPassword,
                props: true,
                meta: { guest: true },
        },

        /**
         * CONNECTED
         */
        {
                path: "/YDA",
                name: "ConnectedHome",
                component: ConnectedHome,
                meta: { requiresAuth: true },
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
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "manager") {
                                router.push('/admin')
                        }
                }
        },
        // Add a product to the catalogue -
        {
                path: "/ajouter-produit",
                name: "adminProductAdd",
                component: AddProduct,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" && role == "manager") {
                                router.push('/admin')
                        }
                }

        },
        // View a specific catalogue item -
        {
                path: "/catalogue/:id",
                name: "individualProduct",
                component: ProductDisplay,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "manager") {
                                router.push('/YDA')
                        }
                }
        },
        // Update catalogue item
        {
                path: "/catalogue/:id/modifier",
                name: "itemUpdate",
                component: ProductUpdate,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                },
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
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                }
        },
        // Add a company -
        {
                path: "/ajouter-entreprise",
                name: "adminAddCompany",
                component: AddCompany,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                }

        },
        // View a specific company -
        {
                path: "/entreprise/:id",
                name: "individualCompany",
                component: CompanyDisplay,
                props: true,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member") {
                                router.push('/YDA')
                        }
                }
        },
        // Update company
        {
                path: "/entreprise/:id/modifier",
                name: "companyUpdate",
                component: CompanyUpdate,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                },
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
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member") {
                                router.push('/YDA')
                        }
                }
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
                path: "/membre/:id/modifier",
                name: "membreUpdate",
                component: MemberUpdate,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member") {
                                router.push('/YDA')
                        }
                },
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
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "admin" || role == "manager") {
                                router.push('/YDA')
                        }
                }
        },
        {
                path: "/commandes",
                name: "orders",
                component: OrdersList,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                }


        },

        {
                path: "/commandes/:id/modifier",
                name: "individualorder",
                component: OrderUpdate,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                }


        },



        /**
        * NEWS
        */

        // View the full news -
        {
                path: "/actualités",
                name: "adminNews",
                component: NewsList,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member") {
                                router.push('/YDA')
                        }
                }
        },
        // Add a news -
        {
                path: "/entreprise/:id/ajout-actualité",
                name: "adminNewsAdd",
                component: AddNews,
                meta: { requiresAuth: true },
                async beforeEnter() {
                        const getUser = await axios.get("/api/login");
                        console.log("response role", getUser.data.role)
                        const role = getUser.data.role

                        if (role == "member" || role == "manager") {
                                router.push('/YDA')
                        }
                },
                props: true
        },

];



const router = createRouter({
        history: createWebHistory(),
        routes,
});

export default router

// router.beforeEach((to, _1, next) =>{
//         console.log('global before each');
//         if (to.path === '/catalogue'){
//             next();
//         } else {
//             next()
//         }
// });

