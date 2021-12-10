<!--
-- View catalogue page component
-->

<template>
  <div>
    <Header title="Catalogue" subtitle="Produits et services" />
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "productList",
  components: {
    Header,
  },
};
</script>

<style>
</style>