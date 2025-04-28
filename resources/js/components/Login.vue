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
                <p v-if="errors.email" class="text-red-500 text-sm mt-1">
                    {{ errors.email[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Пароль</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.password" class="text-red-500 text-sm mt-1">
                    {{ errors.password[0] }}
                </p>
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

<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const form = reactive({
    email: "",
    password: "",
});
const errors = reactive({});

/**
 * Відправка запиту на логін
 */
async function login() {
    // очистити попередні помилки
    Object.keys(errors).forEach((key) => delete errors[key]);

    try {
        // отримати CSRF-кукі
        await axios.get("/sanctum/csrf-cookie");
        // авторизація
        let r = await axios.post("/api/login", form);

        localStorage.setItem("authenticated", true);
        // перенаправлення після успіху
        router.push({ name: "weather" });
    } catch (err) {
        // обробка помилок валідації
        if (err.response?.status === 422) {
            Object.assign(errors, err.response.data.errors);
        }
    }
}
</script>

<style scoped>
/* component-specific styles here */
</style>
