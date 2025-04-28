import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            authenticated: localStorage.getItem("authenticated") === "true",
        };
    },
    mutations: {
        setAuthenticated(state, authenticated) {
            state.authenticated = authenticated;
            localStorage.setItem("authenticated", authenticated);
        },
        clearAuthenticated(state) {
            state.authenticated = false;
            localStorage.removeItem("authenticated");
        },
    },
    actions: {
        login({ commit }) {
            commit("setAuthenticated", true);
        },
        logout({ commit }) {
            commit("clearAuthenticated");
        },
    },
    getters: {
        isAuthenticated: (state) => state.authenticated,
    },
});

export default store;
