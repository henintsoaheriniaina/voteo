<script setup>
import { RouterLink } from "vue-router";
import NavLogo from "../general/NavLogo.vue";
</script>
<template>
  <div class="flex items-center justify-between py-2 max-w-7xl px-6 mx-auto">
    <NavLogo />
    <div class="flex items-center justify-center gap-4">
      <RouterLink to="/" class="nav-link">Sign Up</RouterLink>
      <RouterLink to="/" class="nav-link">Sign In</RouterLink>
      <RouterLink to="/" class="btn-accent">Create</RouterLink>
    </div>
  </div>
</template>
