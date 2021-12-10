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
  </div>
</template>

<script>
import Header from "./components/ui/Header.vue";
export default {
  name: "Home",
  components: {
    Header,
  },
};
</script>

<style>
</style>