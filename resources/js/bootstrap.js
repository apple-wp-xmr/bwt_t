import axios from "axios";

window.axios = axios;
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response.status === 401 || error.response.status === 419) {
            localStorage.removeItem("authenticated");
            window.location.href = "/login";
        }
        return Promise.reject(error);
    }
);
