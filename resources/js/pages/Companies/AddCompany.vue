<!--
-- Add company page component
-->

<template>
  <div>
    <Header
      title="Ajouter une entreprise"
      subtitle="Tapez le SIRET afin de pré remplir"
    />
    <form action="" method="post"></form>
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "addCompany",
  components: {
    Header,
  },
};
</script>

<style>
</style>