<!--
-- View news list page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Les actualités" subtitle="Les actualités récentes" />
    <br />
    <div>
      Pour la société n° {{ id }} qui s'appelle {{ company.name }} vous avez ces
      YD'Actualités
    </div>
    <BackButton />
    <p>______</p>
    <button @click="newsAdd">Ajouter une actualité</button>
    <br />
    <p>______</p>
    <br />
    <br />
    <div v-for="news in newsArray" :key="news.id">
      <h2>
        <strong> {{ news.title }} </strong>
      </h2>
      <p>{{ news.text }}</p>
      <i> {{ new Date(news.created_at).toLocaleString() }} </i>
      <br />
      <button class="btn btn-danger" @click="deleteActuality(news.id)">
        Effacer l'actualité
      </button>
      <br />
      <br />
      <br />
      <br />
    </div>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import axios from "axios";
export default {
  name: "adminNews",
  components: {
    Header,
    BackButton,
  },

  data() {
    return {
      id: 1,
      company: {},
      newsArray: [],
    };
  },
  methods: {
    newsAdd() {
      this.$router.push({ name: "adminNewsAdd" });
    },
    async retrieveActuality() {
      const response = await axios.get("/api/company/" + this.id, {
        headers: {
          Authorization: "bearer " + localStorage.getItem("userToken"),
        },
      });

      console.log(response.data);
      this.company = response.data;

      const responseNews = await axios.get("/api/news");
      this.newsArray = responseNews.data;
      console.log(this.newsArray);
    },
    async refreshList() {
      this.retrieveActuality();
      this.actuality = null;
    },

    /** Delete a specific actuality */
    deleteActuality(actuality_id) {
      if (confirm("Etes-vous sur d'effacer cette actualité ?")) {
        axios
          .delete(`api/news/${actuality_id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => this.refreshList());
      }
    },
  },
  mounted() {
    this.retrieveActuality();
  },
};
</script>

<style>
</style>
