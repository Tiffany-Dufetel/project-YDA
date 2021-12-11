<!--
-- View catalogue page component
-->

<template>
  <div>
    <Header title="Catalogue" subtitle="Produits et services" />
    <CatalogueDisplay />
    <router-link to="admin/catalogue/add"
      ><button>Add item</button></router-link
    >
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import CatalogueDisplay from "../../../components/ui/CatalogueDisplay.vue";
export default {
  name: "productList",
  components: {
    Header,
    CatalogueDisplay,
  },
};
</script>

<style>
</style>