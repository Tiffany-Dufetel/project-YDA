<!--
-- View specific product page component
BACK BUTTON + DISPLAY
-->

<template>
  <div>
    <!-- make title and subtitle responsive -->
    <Header title="namfezfzeet" subtitle="something else...." /><br /><br />

    <div v-for="(product, index) in productArray" :key="index">
      <small>{{ product.type }} / {{ product.category }}</small>
      <h3>{{ product.name }}</h3>
      <p>{{ product.description }}</p>
      <div>
        <img :src="product.image" class="image_product" />
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "ProductDisplay",
  components: {
    Header,
  },
  data() {
    return {
      products: null,
      productArray: [],
      url_data: null,
    };
  },
  async mounted() {
    const response = await axios.get("/api/product/" + this.$route.params.id);
    this.productArray = response.data;

    console.log("coucou", this.productArray);
  },
};
</script>

<style>
</style>
