import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

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

router.beforeEach((to, from, next) => {
    const isAuthenticated = store.getters.isAuthenticated;

    if (!isAuthenticated) {
        if (to.name === "login" || to.name === "register") {
            return next();
        } else {
            return next({
                name: "login",
            });
        }
    }

    if (to.name === "login" || (to.name === "register" && !!isAuthenticated)) {
        return next({
            name: "weather",
        });
    }

    next();
});

export default router;
