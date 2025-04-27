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
        meta: { requiresAuth: true },
    },
    {
        path: "/feedback",
        name: "feedback-form",
        component: FeedbackForm,
        meta: { requiresAuth: true },
    },
    {
        path: "/feedbacks",
        name: "feedback-list",
        component: FeedbackList,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard for auth-protected routes
// router.beforeEach((to, from, next) => {
//     const isAuthenticated = !!localStorage.getItem("auth_token");
//     if (to.meta.requiresAuth && !isAuthenticated) {
//         return next({ name: "login" });
//     }
//     next();
// });

export default router;
