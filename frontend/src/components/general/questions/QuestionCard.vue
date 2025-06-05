<script setup>
import { RouterLink } from "vue-router";

const props = defineProps({
  question: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="shadow-md p-6 rounded-xl flex flex-col gap-4">
    <h3 class="font-semibold text-xl">{{ question.title }}</h3>
    <p>Posted by {{ question.user.name }}</p>
    <p>{{ question.created_at }} ago</p>
    <div class="">
      <RouterLink to="/" class="btn-accent">See more</RouterLink>
    </div>
  </div>
</template>
