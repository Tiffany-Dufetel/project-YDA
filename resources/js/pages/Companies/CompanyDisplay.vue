<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="name of company" subtitle="" />
    <div>Companie n° {{ id }} qui s'appelle {{ company.name }}</div>

    <!--  <tr v-for="company in companyArray" :key="company.id">
      <td>{{ company.name }}</td>
      <td>{{ company.siret }}</td>
    </tr> -->
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "CompanyDisplay",
  components: {
    Header,
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },
  //["id"],

  data() {
    return {
      company: {},
    };
  },

  async mounted() {
    //const getCompanyId = await axios.get("/api/company/");
    const response = await axios.get("/api/company/" + this.id);

    console.log(response.data);

    this.company = response.data;
  },

  /* async mounted() {
    const token = localStorage.getItem("userToken");
    console.log("tk", token);
    const url =
      "https://dw-s3-nice-tijean.osc-fr1.scalingo.io/user/" + this.userId;
    const options = {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + token,
      },
    };
    const response = await fetch(url, options);
    const data = await response.json();
    console.log("oups", data);
    this.firstname = data.firstname;
    this.lastname = data.lastname;
    this.description = data.description;
    this.visitedCountry = data.visitedCountry;
    this.travellerType = data.travellerType;
  },*/
};
</script>

<style>
</style>
