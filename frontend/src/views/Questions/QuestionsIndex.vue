<script setup>
import QuestionCard from "@/components/general/questions/QuestionCard.vue";
import useQuestionsStore from "@/stores/questions";
import { Loader } from "lucide-vue-next";
import { onMounted } from "vue";
const questionsStore = useQuestionsStore();
onMounted(async () => {
  questionsStore.fetchQuestions();
});
</script>
<template>
  <div class="mx-auto max-w-7xl px-6 mt-12">
    <h1 class="text-3xl md:text-4xl font-semibold">Questions</h1>
    <div
      v-if="questionsStore.isLoading"
      class="flex items-center justify-center text-blue-600 mt-12"
    >
      <Loader class="animate-spin" size="40" />
    </div>
    <div
      class="pb-12 space-y-12"
      v-else-if="questionsStore.questions.length > 0"
    >
      <div
        class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2 lg:grid-cols-3 min-h-screen grid-rows-4"
      >
        <QuestionCard
          :question="question"
          v-for="question in questionsStore.questions"
          :key="question.id"
        />
      </div>
      <div class="flex items-center justify-between">
        <button
          class="nav-link cursor-pointer"
          :disabled="questionsStore.currentPage == 1"
          @click="questionsStore.fetchQuestions(questionsStore.prevPageUrl)"
        >
          Previous
        </button>
        <p>
          Page
          <span class="text-blue-600 font-semibold">{{
            questionsStore.currentPage
          }}</span>
          of
          {{ questionsStore.lastPage }}
        </p>
        <button
          class="nav-link cursor-pointer"
          :disabled="questionsStore.currentPage == questionsStore.lastPage"
          @click="questionsStore.fetchQuestions(questionsStore.nextPageUrl)"
        >
          Next
        </button>
      </div>
    </div>
    <div v-else>No questions found</div>
  </div>
</template>
