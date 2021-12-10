<!--
-- Product order form page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header
      title="name of product"
      subtitle="Placez votre commande ici, nous vous contacterons en suite"
    />
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "productOrder",
  components: {
    Header,
  },
};
</script>

<style>
</style>