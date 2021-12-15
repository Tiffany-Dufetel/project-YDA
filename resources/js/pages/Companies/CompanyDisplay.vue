<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header title="name of company" subtitle="" />
    <BackButton />
    <div>Client : {{ company.name }}</div>
  </div>
  <div>
      <div>
          <p>Siret : {{company.siret}}</p>
          <p>Responsable : <!-- {{users.first_name}} {{users.surname}}--></p>
          <p>Adresse : {{company.adress}} - {{company.postcode}} {{company.city}}</p>

      </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";

export default {
  name: "CompanyDisplay",
  components: {
    Header,
    BackButton,
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
      user:{},
    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);
    const userResponse = await axios.get("api/user/"+ this.id);
    console.log(response.data);
    console.log(userResponse.data);

    this.company = response.data;
  },
};
</script>

<style>
</style>
