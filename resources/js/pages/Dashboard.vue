<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import WeatherCard from '../components/WeatherCard.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

// Accept weather prop from the controller
const props = defineProps<{
  weather: {
    name: string;
    main: { temp: number; humidity: number };
    weather: { description: string }[];
    wind: { speed: number };
  };
}>();

// Debug: log the weather prop
console.log('Weather prop:', props.weather);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Weather Card -->
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <h2 class="text-lg font-semibold mb-2">Weather in {{ props.weather.name }}</h2>
                    <p>Temperatuur: {{ props.weather.main.temp }} °C</p>
                    <p>Condition: {{ props.weather.weather[0].description }}</p>
                    <p>Niiskus: {{ props.weather.main.humidity }}%</p>
                    <p>Tuulekiirus: {{ props.weather.wind.speed }} m/s</p>
                </div>

                <!-- Placeholder Cards -->
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>

            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
