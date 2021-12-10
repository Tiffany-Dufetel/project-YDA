<!--
-- Company home page component
-->

<template>
  <div>
    <Header
      title="Bienvue à votre page"
      subtitle="Gérer vos membres et statistiques ici"
    />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "companyHome",
  components: {
    Header,
  },
};
</script>

<style>
</style>