require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import Home from "./pages/Home.vue";
import Contact from "./pages/Contact.vue";
import MembersList from "./pages/Members/MembersList.vue";

createApp({
    components: {
        Home,
        Contact,
        MembersList,
    },
})
    .use(router)

    .mount("#app");
