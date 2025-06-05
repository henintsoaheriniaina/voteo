<script setup>
import { HandCoins } from "lucide-vue-next";
import { RouterLink } from "vue-router";
</script>
<template>
  <RouterLink
    :to="{ name: 'home' }"
    class="flex items-center justify-center gap-2"
  >
    <div class="font-semibold text-2xl">Voteo</div>
    <div class="bg-blue-600 text-white p-1.5 rounded-md"><HandCoins /></div>
  </RouterLink>
</template>
