require("./bootstrap");

import { createApp } from "vue";
import router from "./router";

import Home from "./pages/Home.vue";
import Contact from "./pages/Contact.vue";
import AdminHome from "./pages/Admin/AdminHome.vue";

createApp({
    components: {
        Home,
        Contact,
        AdminHome,
    },
})
    .use(router)

    .mount("#app");
