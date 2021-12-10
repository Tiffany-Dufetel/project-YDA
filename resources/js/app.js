require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import Home from "./pages/Home.vue";
import Contact from "./pages/Contact.vue";

createApp({
    components: {
        Home,
        Contact,
    },
})
    .use(router)

    .mount("#app");
