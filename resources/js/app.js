require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
<<<<<<< HEAD

import Home from "./pages/Home.vue";
=======
import Home from "./pages/Home.vue";
import Contact from "./pages/Contact.vue";
>>>>>>> origin/master

createApp({
    components: {
        Home,
<<<<<<< HEAD
=======
        Contact,
>>>>>>> origin/master
    },
})
    .use(router)

    .mount("#app");
