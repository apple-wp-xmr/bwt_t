<template>
    <div class="max-w-md mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Логін</h1>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full border rounded p-2"
                />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Пароль</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full border rounded p-2"
                />
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded"
                >
                    Увійти
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Login",
    data() {
        return {
            form: { email: "", password: "" },
            errors: {},
        };
    },
    methods: {
        async login() {
            this.errors = {};
            try {
                await axios.post("/api/login", this.form);
                this.$router.push({ name: "Weather" });
            } catch (err) {
                if (err.response && err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            }
        },
    },
};
</script>

<style scoped></style>
