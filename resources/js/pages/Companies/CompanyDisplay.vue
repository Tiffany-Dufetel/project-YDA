<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="name of company" subtitle="" />
    <div>Companie n° {{ id }} qui s'appelle {{ company.name }}</div>
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
};
</script>

<style>
</style>
