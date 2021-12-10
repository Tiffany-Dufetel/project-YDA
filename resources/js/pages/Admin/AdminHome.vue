<!--
-- Admin home page component
-->

<template>
  <div>
    <Header title="Home" subtitle="Manage companies and your catalogue here" />
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "adminHome",
  components: {
    Header,
  },
};
</script>

<style>
</style>