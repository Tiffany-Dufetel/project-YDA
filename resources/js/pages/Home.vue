<!--
-- Home page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header
      title="Your Daily Assistant"
      subtitle="Faciliter la vie avec notre conciergerie"
    />
    <CatalogueDisplay />

    <p>yes</p>
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
import CatalogueDisplay from "../components/ui/CatalogueDisplay.vue";

export default {
  name: "Home",
  components: {
    Header,
    CatalogueDisplay,
  },
};
</script>

<style>
</style>
