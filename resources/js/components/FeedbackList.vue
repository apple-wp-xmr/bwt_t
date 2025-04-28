<template>
    <div class="max-w-lg mx-auto p-4">
        <h2 class="text-xl font-semibold mb-3">Список відгуків</h2>
        <ul class="space-y-2">
            <li
                v-for="item in feedbacks"
                :key="item.id"
                class="border p-3 rounded"
            >
                <p>
                    <strong>{{ item.name }}</strong> ({{ item.email }})
                </p>
                <p>{{ item.message }}</p>
                <p>{{ item.created_at }}</p>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const feedbacks = ref([]);

async function loadFeedbacks() {
    try {
        const response = await axios.get("/api/feedback");
        feedbacks.value = response.data;
    } catch (error) {
        console.error("Error loading feedbacks:", error);
    }
}

onMounted(() => {
    loadFeedbacks();
});
</script>

<style scoped></style>
