<!--
-- Add managers page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Name of company" subtitle="Ajouter vos managers" />
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "addManagers",
  components: {
    Header,
  },
};
</script>

<style>
</style>