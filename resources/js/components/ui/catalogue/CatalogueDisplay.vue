<!--
-- Catalogue Display UI component
-->

<template>
  <div>
    <!-- needs developing!! -->
    <div v-for="product in products" :key="product" :value="product.id">
      {{ product.name }}
    </div>
  </div>
</template>

<script>
export default {
  name: "Catalogue",
  data() {
    return {
      products: [],
    };
  },
  // fetch the list of products on view creation using sanctum in axios
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/product")
        .then((response) => {
          this.products = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    });
  },
};
</script>

<style scoped>
</style>