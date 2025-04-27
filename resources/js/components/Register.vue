<template>
    <div class="max-w-md mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Реєстрація</h1>
        <form @submit.prevent="register">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Ім'я</label>
                <input
                    v-model="form.first_name"
                    type="text"
                    class="w-full border rounded p-2"
                />
                <p v-if="errors.first_name" class="text-red-500 text-sm">
                    {{ errors.first_name[0] }}
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

<script>
import axios from "axios";
export default {
    name: "Register",
    data() {
        return {
            form: {
                first_name: "",
                last_name: "",
                email: "",
                gender: "",
                birth_date: "",
            },
            errors: {},
        };
    },
    methods: {
        async register() {
            this.errors = {};
            try {
                await axios.post("/api/register", this.form);
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

<style scoped>
/* add component-specific styles here */
</style>
