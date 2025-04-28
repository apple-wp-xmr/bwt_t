<!-- resources/js/src/components/FeedbackForm.vue -->
<template>
    <div class="max-w-md mx-auto p-4">
        <h2 class="text-xl font-semibold mb-3">Зворотний зв'язок</h2>
        <form @submit.prevent="submitFeedback">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1"
                    >Повідомлення</label
                >
                <textarea
                    v-model="form.message"
                    class="w-full border rounded p-2"
                ></textarea>
                <p v-if="errors.message" class="text-red-500 text-sm">
                    {{ errors.message[0] }}
                </p>
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

<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();

// реактивні стани форми та помилок
const form = reactive({
    message: "",
});
const errors = reactive({});

async function submitFeedback() {
    // очистити помилки
    Object.keys(errors).forEach((key) => delete errors[key]);

    try {
        await axios.post("/api/feedback", form);
        // після успіху перенаправити на список фідбеків
        router.push({ name: "feedback-list" });
    } catch (err) {
        if (err.response?.status === 422) {
            Object.assign(errors, err.response.data.errors);
        }
    }
}
</script>

<style scoped>
/* component-specific styles here */
</style>
