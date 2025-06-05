import { defineStore } from "pinia";
const useQuestionsStore = defineStore("questions", {
  state: () => ({
    questions: [],
    error: null,
    isLoading: false,
    currentPage: 1,
    lastPage: 1,
    nextPageUrl: null,
    prevPageUrl: null,
  }),
  actions: {
    async fetchQuestions(url = "/api/questions") {
      console.log(url);

      try {
        this.isLoading = true;
        const res = await fetch(url);
        const { questions } = await res.json();
        if (res.ok) {
          this.questions = questions.data;
          this.currentPage = questions.current_page;
          this.lastPage = questions.last_page;
          this.nextPageUrl = questions.next_page_url;
          this.prevPageUrl = questions.prev_page_url;
        } else {
          throw new Error("Error while loading questions");
        }
      } catch (error) {
        this.error = error.message;
      } finally {
        this.isLoading = false;
      }
    },
  },
});
export default useQuestionsStore;
