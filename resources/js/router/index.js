import { createRouter, createWebHistory } from "vue-router";

// Components
import Register from "../components/Register.vue";
import Login from "../components/Login.vue";
import Weather from "../components/Weather.vue";
import FeedbackForm from "../components/FeedbackForm.vue";
import FeedbackList from "../components/FeedbackList.vue";

const routes = [
    {
        path: "/",
        name: "register",
        component: Register,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/weather",
        name: "weather",
        component: Weather,
    },
    {
        path: "/feedback",
        name: "feedback-form",
        component: FeedbackForm,
    },
    {
        path: "/feedbacks",
        name: "feedback-list",
        component: FeedbackList,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
