<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="name of company" subtitle="" />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "companyDisplay",
  components: {
    Header,
  },
};
</script>

<style>
</style>