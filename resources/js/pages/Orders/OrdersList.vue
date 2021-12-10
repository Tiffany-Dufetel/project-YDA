<!--
-- Order list display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="name of member or company" subtitle="Commandes" />
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "orderList",
  components: {
    Header,
  },
};
</script>

<style>
</style>