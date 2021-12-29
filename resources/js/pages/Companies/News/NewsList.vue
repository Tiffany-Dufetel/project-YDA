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

    <p>______</p>
    <br />
    <br />

    <div v-for="news in newsArray" :key="news.id">
    <p>Pour l'entreprise {{ company.name }} </p>
      <h3>
        <strong> {{ news.title }} </strong>
      </h3>
      <p>{{ news.text }}</p>
      <i> {{ new Date(news.created_at).toLocaleString() }} </i>
      <br />
      <button class="btn-delete" @click="deleteActuality(news.id)">
        <ion-icon name="trash"></ion-icon>
      </button>
      <br />
      <br />
      <p>___________________</p>
      <br />
      <br />
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
    company: {},
    newsArray: [],
    companies: [],



    };
  },

  methods: {

    async retrieveActuality() {
      const response = await axios.get("/api/company/", {
        headers: {
        Authorization: "bearer " + localStorage.getItem("userToken"),
        },
      });

      console.log(response.data);
      this.company = response.data.data;


      const responseNews = await axios.get("/api/news");
      this.newsArray = responseNews.data;
      console.log("this", this.newsArray);

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
