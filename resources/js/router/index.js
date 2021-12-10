import { createRouter, createWebHistory } from "vue-router";
import MembersList from "../components/Members/MembersList.vue";

const routes = [
    {
        path: "/",
        name: "members",
        component: MembersList,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
