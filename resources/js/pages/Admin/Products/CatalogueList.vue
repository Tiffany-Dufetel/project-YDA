<!--
-- View catalogue page component
-->

<template>
  <div>
    <Header title="Catalogue" subtitle="Produits et services" />
    <BackButton />
    <CatalogueDisplay />
    <AddButton name="Ajouter Produit" @click="add" />
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import CatalogueDisplay from "../../../components/ui/catalogue/CatalogueDisplay.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import AddButton from "../../../components/ui/buttons/AddButton.vue";

export default {
  name: "productList",
  components: {
    Header,
    CatalogueDisplay,
    BackButton,
    AddButton,
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