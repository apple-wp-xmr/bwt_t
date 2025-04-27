<template>
    <div class="p-6">
        <nav class="mb-6">
            <router-link
                class="mr-4 text-blue-600 hover:underline"
                :to="{ name: 'register' }"
                >Register</router-link
            >
            <router-link
                class="mr-4 text-blue-600 hover:underline"
                :to="{ name: 'login' }"
                >Login</router-link
            >
            <router-link
                class="mr-4 text-blue-600 hover:underline"
                :to="{ name: 'weather' }"
                >Weather</router-link
            >
            <router-link
                class="mr-4 text-blue-600 hover:underline"
                :to="{ name: 'feedback-form' }"
                >Feedback</router-link
            >
            <router-link
                class="text-blue-600 hover:underline"
                :to="{ name: 'feedback-list' }"
                >Feedbacks</router-link
            >
        </nav>

        <router-view />
    </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();
const count = computed(() => store.state.count);
</script>

<style scoped>
/* You can add global or component-specific styles here */
</style>
