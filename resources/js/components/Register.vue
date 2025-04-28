<!-- resources/js/src/components/Register.vue -->
<template>
    <div class="max-w-md mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Реєстрація</h1>
        <form @submit.prevent="register">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Ім'я</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.name" class="text-red-500 text-sm">
                    {{ errors.name[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Прізвище</label>
                <input
                    v-model="form.last_name"
                    type="text"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.last_name" class="text-red-500 text-sm">
                    {{ errors.last_name[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.email" class="text-red-500 text-sm">
                    {{ errors.email[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Стать</label>
                <select v-model="form.gender" class="w-full border rounded p-2">
                    <option value="">Оберіть</option>
                    <option value="male">Чоловіча</option>
                    <option value="female">Жіноча</option>
                </select>
                <p v-if="errors.gender" class="text-red-500 text-sm">
                    {{ errors.gender[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1"
                    >Дата народження</label
                >
                <input
                    v-model="form.birth_date"
                    type="date"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.birth_date" class="text-red-500 text-sm">
                    {{ errors.birth_date[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Пароль</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.password" class="text-red-500 text-sm">
                    {{ errors.password[0] }}
                </p>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1"
                    >Підтвердження пароля</label
                >
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    class="w-full border rounded p-2"
                />
                <p
                    v-if="errors.password_confirmation"
                    class="text-red-500 text-sm"
                >
                    {{ errors.password_confirmation[0] }}
                </p>
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Зареєструватися
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import { useStore } from "vuex";

const router = useRouter();

// реактивний об'єкт форми та помилок
const form = reactive({
    name: "",
    last_name: "",
    email: "",
    gender: "",
    birth_date: "",
    password: "",
});

const errors = reactive({});
const store = useStore();

/**
 * Відправка запиту на реєстрацію
 */
async function register() {
    // очистити попередні помилки
    Object.keys(errors).forEach((key) => delete errors[key]);

    // перевірка підтвердження пароля
    if (form.password !== form.password_confirmation) {
        errors.password_confirmation = ["Паролі не збігаються"];
        return;
    }

    try {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/api/register", form);
        await store.dispatch("login");
        router.push({ name: "weather" });
    } catch (err) {
        if (err.response?.status === 422) {
            // заповнити об'єкт errors відповідно до відповіді
            Object.assign(errors, err.response.data.errors);
        }
    }
}
</script>

<style scoped>
/* component-specific styles here */
</style>
