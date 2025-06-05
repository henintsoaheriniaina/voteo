<script setup>
import { RouterLink } from "vue-router";
</script>
<template>
  <main
    style="height: calc(100vh - 56px)"
    class="pt-52 bg-linear-to-b from-white from-60% to-blue-300"
  >
    <div class="flex flex-col items-center justify-center gap-4 text-center">
      <h1 class="font-bold text-4xl md:text-6xl">
        Lorem ipsum, dolor sit amet.
      </h1>
      <p class="text-blue-900/50 md:text-xl">
        Consectetur adipisicing elit. Sequi earum nam debitis eum? Nostrum ipsa
      </p>
      <div class="gap-2 flex items-center justify-center">
        <RouterLink
          :to="{ name: 'questions.index' }"
          class="bg-blue-100 py-2 rounded-md text-blue-600 px-6 text-xl font-semibold"
          >Questions</RouterLink
        >
        <RouterLink class="btn-accent px-6 text-xl font-semibold" to="/"
          >Create</RouterLink
        >
      </div>
    </div>
  </main>
</template>
