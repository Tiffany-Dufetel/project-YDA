<!--
-- Member individual display page component
-->

<template>
  <div>
    <!-- rendre les noms reactive -->
    <Header title="name of company" subtitle="name of member" />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "memberDisplay",
  components: {
    Header,
  },
};
</script>

<style>
</style>