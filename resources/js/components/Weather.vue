<template>
    <div class="max-w-lg mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Погода в Запоріжжі</h1>
        <div v-if="weather" class="space-y-2">
            <p>Температура: {{ weather.temperature }}°C</p>
            <p>Опис: {{ weather.description }}</p>
            <p>Вологість: {{ weather.humidity }}%</p>
        </div>
        <button
            @click="fetchWeather"
            class="mt-4 bg-blue-500 text-white px-3 py-1 rounded"
        >
            Оновити
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const weather = ref(null);
async function fetchWeather() {
    try {
        const { data } = await axios.get("/api/weather");
        weather.value = data;
    } catch (e) {
        console.error("Не вдалося отримати погоду:", e);
    }
}

onMounted(() => {
    fetchWeather();
});
</script>

<style scoped></style>
