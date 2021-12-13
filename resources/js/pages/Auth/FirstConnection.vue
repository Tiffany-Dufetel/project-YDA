<!--
-- First Connection Page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre compte YDA"
      subtitle="Veuillez réinitialer votre mot de passe"
    />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "firstConnection",
  components: {
    Header,
  },
};
</script>

<style>
</style>