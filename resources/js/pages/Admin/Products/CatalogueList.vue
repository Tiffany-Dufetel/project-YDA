<!--
-- View catalogue page component
-->

<template>
  <div>
    <Header title="Catalogue" subtitle="Produits et services" />
    <CatalogueDisplay />

    <button @click="add">Ajouter Produit</button>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import CatalogueDisplay from "../../../components/ui/catalogue/CatalogueDisplay.vue";
export default {
  name: "productList",
  components: {
    Header,
    CatalogueDisplay,
  },
  methods: {
    add() {
      this.$router.push({ name: "adminProductAdd" });
    },
  },
};
</script>

<style>
</style>