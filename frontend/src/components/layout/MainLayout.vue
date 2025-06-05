<script setup>
import NavBar from "./NavBar.vue";
</script>
<template>
  <div class="min-h-screen">
    <NavBar />
    <div>
      <slot />
    </div>
  </div>
</template>
<style></style>
