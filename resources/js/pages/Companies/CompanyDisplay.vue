<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header title="name of company" subtitle="" />
    <div>Client : {{ company.name }}</div>
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
    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);
    const userResponse = await axios.get("api/user/" + this.id);
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("user", this.role);
    console.log(response.data);
    console.log(userResponse.data);

    this.company = response.data;
  },
};
</script>

<style>
</style>
