<!--
-- Contact page component
-->

<template>
  <div>
    <Header
      title="Contactez-nous par mail ou téléphone"
      subtitle="Nous vous repondrons avec grand plaisir sous 24 heures"
    />

    <h3>Email:</h3>
    <h3>Number:</h3>
  </div>
</template>

<script>
import Header from "./components/ui/Header.vue";
export default {
  name: "contact",
  components: {
    Header,
  },
};
</script>

<style>
</style>