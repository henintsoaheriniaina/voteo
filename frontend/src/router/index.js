import QuestionsIndex from "@/views/Questions/QuestionsIndex.vue";
import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/questions",
      name: "questions.index",
      component: QuestionsIndex,
    },
  ],
});

export default router;
