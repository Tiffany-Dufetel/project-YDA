<!--
-- View specific product page component
-->

<template>
  <div>
    <!-- make title and subtitle responsive -->
    <Header title="name of product" subtitle="something else...." />
    <!-- <div v-for="(product,index) in productArray" :key="index">
        {{ product.name }}
    <div> -->
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "ProductDisplay",
  components: {
    Header,
  },
    data(){
        return{
            products: null,
            productArray: [],
            url_data: null
        }
    },
  async mounted(){
      const userId = this.$route.params.id
      const userToken = localStorage.getItem("userToken")
      const url = `/api/product/${userId}`
    const options = {
        method: "GET",
        headers: {
            'Content-Type': "application/json",
            'Authorization': "Bearer " + userToken,
        },
    };

      const response = await axios.get(url,options);


      console.log("product",url);
  }
};
</script>

<style>
</style>
