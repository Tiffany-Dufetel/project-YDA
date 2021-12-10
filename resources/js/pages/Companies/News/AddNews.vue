<!--
-- Add news page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Name of company" subtitle="Ajouter les actualités" />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "addNews",
  components: {
    Header,
  },
};
</script>

<style>
</style>