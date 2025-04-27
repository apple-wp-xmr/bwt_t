<template>
    <div class="max-w-md mx-auto p-4">
        <h2 class="text-xl font-semibold mb-3">Зворотний зв'язок</h2>
        <form @submit.prevent="submitFeedback">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Ім'я</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full border rounded p-2"
                />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full border rounded p-2"
                />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1"
                    >Повідомлення</label
                >
                <textarea
                    v-model="form.message"
                    class="w-full border rounded p-2"
                ></textarea>
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-purple-500 text-white px-4 py-2 rounded"
                >
                    Надіслати
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "FeedbackForm",
    data() {
        return { form: { name: "", email: "", message: "" }, errors: {} };
    },
    methods: {
        async submitFeedback() {
            this.errors = {};
            try {
                await axios.post("/api/feedback", this.form);
                this.$emit("submitted");
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
