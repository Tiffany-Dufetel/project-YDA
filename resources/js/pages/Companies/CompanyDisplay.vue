<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header v-model:title="company.name" subtitle="" />
  </div>
  <div>
    <div>
      <p>Siret : {{ company.siret }}</p>

      <p>
        Adresse : {{ company.adress }} - {{ company.postcode }}
        {{ company.city }}
      </p>

      <button @click="isHidden = !isHidden">
        {{ isHidden ? "Ajouter un membre" : "Masquer le formulaire" }}
      </button>

      <!--  Add members -->
      <AddMember v-if="!isHidden" title="Ajouter un membre" subtitle="" />
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import AddMember from "../../components/ui/forms/AddMember.vue";

export default {
  name: "CompanyDisplay",
  components: {
    Header,
    AddMember,
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  data() {
    return {
      isHidden: true,
      company: {},
      user: {},
      userArray: [],
    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);
    const userResponse = await axios.get("api/user/");
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    this.company = response.data;
    this.userArray = userResponse;
    console.log(this.userArray);
  },
};
</script>

<style>
</style>
