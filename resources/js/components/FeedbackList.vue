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
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "FeedbackList",
    data() {
        return { feedbacks: [] };
    },
    created() {
        this.loadFeedbacks();
    },
    methods: {
        async loadFeedbacks() {
            const response = await axios.get("/api/feedback");
            this.feedbacks = response.data;
        },
    },
};
</script>

<style scoped></style>
