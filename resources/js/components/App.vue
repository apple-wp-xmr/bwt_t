<template>
    <div class="p-6">
        <nav class="mb-6">
            <template v-if="!isAuthenticated">
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
            </template>

            <template v-else>
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
                <button
                    @click="logout"
                    class="text-red-600 hover:underline ml-4"
                >
                    Logout
                </button>
            </template>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script setup>
import { useStore } from "vuex";
import { ref, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const isAuthenticated = computed(() => store.getters.isAuthenticated);
const store = useStore();
const router = useRouter();

async function logout() {
    try {
        await axios.post("/api/logout");
        await store.dispatch("logout");
    } catch (error) {
        console.error("Logout failed:", error);
    } finally {
        router.push({ name: "login" });
    }
}

onMounted(() => {});
</script>

<style scoped>
/* You can add global or component-specific styles here */
</style>
