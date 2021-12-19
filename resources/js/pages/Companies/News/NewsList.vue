<!--
-- View news list page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Les actualités" subtitle="Les actualités récentes" />
<<<<<<< HEAD
    <br/>
    <div>Pour la société n° {{ id }} qui s'appelle {{ company.name }} vous avez ces YD'Actualités </div>
<BackButton />
<p>______</p>
<button @click="newsAdd">Ajouter une actualité</button>
<br/>
<p>______</p>
<br/>
<br/>
        <div v-for="(news, index) in newsArray" :key="index">
            <h2><strong> {{ news.title }} </strong></h2>
            <p> {{ news.text }} </p>
            <i> {{ new Date(news.created_at).toLocaleString() }} </i>
            <br/>
            <br/>
        </div>
=======
    <div>
      Pour la société n° {{ id }} qui s'appelle {{ company.name }} vous avez ces
      actualités
    </div>
    <BackButton />
    <button @click="newsAdd">Ajouter une actualité</button>
    <div v-for="(news, index) in newsArray" :key="index">
      <h2>{{ title }}</h2>
      <p>{{ text }}</p>
    </div>
>>>>>>> origin/master
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

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id, {
      headers: {
        Authorization: "bearer " + localStorage.getItem("userToken"),
      },
    });

    console.log(response.data);
    this.company = response.data;

<<<<<<< HEAD
    const responseNews = await axios.get("/api/news");
    this.newsArray = responseNews.data;
=======
    const responseNews = await axios.get("/api/news" + this.company_id);
    this.newsArray = responseNews.data.data;
>>>>>>> origin/master
    console.log(this.newsArray);
  },

  methods: {
    newsAdd() {
      this.$router.push({ name: "adminNewsAdd" });
    },
  },
};
</script>

<style>
</style>
