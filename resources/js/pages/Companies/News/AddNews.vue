<!--
-- Add news page component
-->

<template>
<div>
    <!-- make title responsive -->
    <Header title="les actualités" subtitle="Ajouter les actualités" />
    <BackButton />

    <div class="container">
        <form class="formContent" method="POST" @submit.prevent="addNews">
            <!-- Specific company choice -->
            <label for="title">Titre de l'actualité</label>
            <input type="text" id="title" name="title" v-model="title" class="inputText marginBot"/>
            <label for="text">Actualité</label>
            <textarea
                class="inputText marginBot"
                name="text"
                id="text"
                v-model="text"
                cols="90"
                rows="4"
            ></textarea>
            <SubmitButton name="Ajouter" />
        </form>
    </div>
</div>
</template>


<script>
import Header from "../../../components/ui/Header.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../../components/ui/buttons/SubmitButton.vue";
import axios from "axios";

export default {
  name: "adminNewsAdd",

  props: {
      id: String
  },

  mounted() {
      console.log(this.id);
  },

  data() {
    return {
      title: "",
      text: "",
      companies: [],
    };
  },
  components: {
    Header,
    BackButton,
    SubmitButton,
  },
  // fetch the list of companies on view creation
  async mounted() {
    const getCompany = await axios.get("/api/company");
    this.companies = getCompany.data.data;
  },
  methods: {
    addNews() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/news", {
            title: this.title,
            text: this.text,
            company_id: Number(this.id)
          })
          .then((response) => {
            console.log(response);
            this.$router.push({ name: "adminNews" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
</style>
