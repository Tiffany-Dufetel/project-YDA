<!--
-- Admin home page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre page administration"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <div class="mt-5">
      <button @click="catView">Voir Catalogue</button>
      <button @click="catAdd">Ajouter dans le catalogue</button>
      <button @click="companyView">Voir entreprises</button>
      <button @click="companyAdd">Ajouter une entreprise</button>
    </div>

    <button @click="order">Commander</button>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import axios from "axios";

export default {
  name: "AdminHome",
  components: {
    Header,
  },

  data() {
    return {
      productArray: [],
    };
  },
  async mounted() {
    const getProduct = await axios.get("/api/product");

    // this.productArray = getProduct.data.data;

    console.log(getProduct);
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
    order() {
      this.$router.push({ name: "productOrder" });
    },
  },
};
</script>

<style>
</style>
