<!--
-- View news list page component
-->

<template>
    <div>
    <!-- make title responsive -->
    <Header title="Les actualités" subtitle="Les actualités récentes" />
    </div>
    <br />


    <BackButton />
<div class="info-news-container">
    <div  class="info-new" v-for="news in newsArray" :key="news.id">
            <h2>
                <strong> {{ news.title }} </strong>
            </h2>
            <p>{{ news.text }}<br>
                <i> {{ new Date(news.created_at).toLocaleString() }} </i>
            </p>

            <br />

            <button class="btn btn-danger" @click="deleteActuality(news.id)">
                Effacer l'actualité
            </button>
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

      newsArray: [],
      companies: [],

    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
     const getCompany = await axios.get("/api/company");
    this.companies = getCompany.data.data;


  },



  methods: {

    async retrieveActuality() {
      const response = await axios.get("/api/company/", {
        headers: {
          Authorization: "bearer " + localStorage.getItem("userToken"),
        },
      });
        console.log(this.companies);
      //console.log(response.data);
      this.company = response.data;

      const responseNews = await axios.get("/api/news");
      this.newsArray = responseNews.data;
      console.log("NEWS",this.newsArray);
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
    console.log(this.companies);
  },
};
</script>

<style>
.info-news-container{
    display: flex;
}

.info-new{
    border: none;
    -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
    box-shadow: 1px 1px 15px 1px #dddddd;
    margin: 10px;
    padding: 33px;
    border-radius: 15px;
    background-color: white;
    height: 277px;
    width: 487px;
}

</style>
