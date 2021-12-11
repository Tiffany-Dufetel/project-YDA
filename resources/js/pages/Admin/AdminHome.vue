<!--
-- Admin home page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre page administration"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <button @click="catView">Voir Catalogue</button>
    <button @click="catAdd">Ajouter dans le catalogue</button>
    <button @click="companyView">Voir entreprises</button>
    <button @click="companyAdd">Ajouter une entreprise</button>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "AdminHome",
  components: {
    Header,
  },
  methods: {
    catView() {
      this.$router.push({ name: "adminCatalogue" });
    },
    catAdd() {
      this.$router.push({ name: "adminProductAdd" });
    },
    companyView() {
      this.$router.push({ name: "adminCompanies" });
    },
    companyAdd() {
      this.$router.push({ name: "adminAddCompany" });
    },
  },
};
</script>

<style>
</style>