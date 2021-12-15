<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
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

  data() {
    return {
      company: {},
    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);

    console.log(response.data);

    this.company = response.data;
  },
};
</script>

<style>
</style>
