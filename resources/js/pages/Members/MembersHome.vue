<!--
-- Member home page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre page"
      subtitle="Gérer vos commandes et profil ici"
    />
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "memberHome",
  components: {
    Header,
  },
};
</script>

<style>
</style>