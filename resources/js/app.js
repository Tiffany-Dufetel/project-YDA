require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import Footer from "./components/assets/Footer.vue";
import Navbar from "./components/assets/Navbar.vue";
import MembersList from "./components/Members/MembersList.vue";
import BackButton from "./components/ui/BackButton.vue";
import Comment from "./components/ui/Comment.vue";
import CommentList from "./components/ui/CommentList.vue";

createApp({
    components: {
        Footer,
        Navbar,
        MembersList,
        BackButton,
        Comment,
        CommentList,
    },
})
    .use(router)

    .mount("#app");
