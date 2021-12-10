require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import MembersList from "./components/pages/Members/MembersList.vue";

createApp({
    components: {
        MembersList,
    },
})
    .use(router)

    .mount("#app");
