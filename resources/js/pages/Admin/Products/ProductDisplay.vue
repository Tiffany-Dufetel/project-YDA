<!--
-- View specific product page component
-->

<template>
  <div>
    <!-- make title and subtitle responsive -->
    <Header title="name of product" subtitle="something else...." />
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "productDisplay",
  components: {
    Header,
  },
};
</script>

<style>
</style>