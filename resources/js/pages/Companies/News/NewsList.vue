<!--
-- View news list page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Name of company" subtitle="Les actualités récentes" />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "viewNewsLsit",
  components: {
    Header,
  },
};
</script>

<style>
</style>