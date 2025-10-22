<template>
    <Card class="bg-blue-50 dark:bg-gray-800">
      <CardHeader>
        <h2 class="text-lg font-semibold">Ilm {{ weather.name }}</h2>
      </CardHeader>
  
      <CardContent class="flex flex-col items-center gap-4">
        <!-- Icon and description -->
        <div class="flex items-center gap-4">
          <img 
            :src="`http://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`" 
            :alt="weather.weather[0].description"
            class="w-16 h-16"
          />
          <span class="text-sm capitalize">{{ weather.weather[0].description }}</span>
        </div>
  
        <!-- Weather details -->
        <div class="flex flex-col gap-1 text-center">
          <p>Temperatuur: <span class="font-medium">{{ weather.main.temp }} °C</span></p>
          <p>Niiskus: <span class="font-medium">{{ weather.main.humidity }}%</span></p>
          <p>Tuulekiirus: <span class="font-medium">{{ weather.wind.speed }} m/s</span></p>
        </div>
      </CardContent>
    </Card>
  </template>
  
  <script setup lang="ts">
  import { Card, CardHeader, CardContent } from "@/components/ui/card";
  
  const props = defineProps<{
    weather: {
      name: string;
      main: { temp: number; humidity: number };
      weather: { description: string; icon: string }[];
      wind: { speed: number };
    };
  }>();
  
  // Make weather easier to reference
  const weather = props.weather;
  </script>
  