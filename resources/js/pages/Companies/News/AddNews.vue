<!--
-- Add news page component
-->

<template>
<div>
    <!-- make title responsive -->
    <Header
    title="les actualités" subtitle="Ajouter les actualités" />
<BackButton />
    <form method="POST" @submit.prevent="addNews">
        <label for="title">Titre de l'actualité</label>
        <br/>
        <input type="text" id="title" name="title" v-model="title">
        <br/>
        <label for="text">Actualité</label>
        <br/>
        <textarea name="text" id="text" v-model="text" cols="90" rows="4"></textarea>
        <SubmitButton name="Ajouter" />
    </form>
</div>
</template>


<script>
import Header from "../../../components/ui/Header.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../../components/ui/buttons/SubmitButton.vue";
import axios from "axios";

export default {
  name: "adminNewsAdd",


  data() {
      return {
          title:"",
          text:"",
      };
  },
  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  methods: {
      addNews() {
          axios.get("/sanctum/csrf-cookie").then((response)=> {
              axios
                .post("/api/news", {
                    title: this.title,
                    text: this.text,
                })
                .then((response) => {
                    console.log(response);
                    this.$router.push({ name: "adminNews"});
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
