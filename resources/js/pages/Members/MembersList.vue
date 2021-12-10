<!--
-- List of members page component
-->

<template>
  <div>
    <!-- make name responsive -->
    <Header title="name of company" subtitle="Tous les membres" />
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "memberList",
  components: {
    Header,
  },
};
</script>

<style>
</style>