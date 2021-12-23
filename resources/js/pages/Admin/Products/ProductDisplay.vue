<!--
-- View specific product page component
-->

<template>
  <div>
    <!-- make title and subtitle responsive -->
    <Header title="Voir les détails" subtitle="" /><br /><br />
    <BackButton />

    <!-- Product card -->
  <div class="d-flex justify-content-center flex-wrap mt-3">
      <div class="card-container" style="width: 25rem">
        <!-- <img
          src="productArray.image"
          class="card-img-top image_product"
          alt="product.description"
        /> -->
        <div class="card-body">
          <h5 class="card-title">{{ productArray.name }}</h5>
          <p class="card-text">
            {{ productArray.description }}
            <i>{{ productArray.type }} / {{ productArray.category }}</i>
          </p>
            <div class="buttons" v-if="role == 'admin'">
                <button @click="edit" class="card-link">Modifier</button>
            </div>
        </div>
      </div>
    </div>

    <!-- Button to modify item if role is admin -->

    <!-- Button to order item if role is member -->
    <div v-if="role == 'member'">
      <button @click="order" class="btn btn-primary">Commandez</button>
    </div>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
export default {
  name: "ProductDisplay",
  components: {
    Header,
    BackButton,
  },
  data() {
    return {
      products: null,
      productArray: {},
      url_data: null,
      role: "",
    };
  },
  async mounted() {
    const response = await axios.get("/api/product/" + this.$route.params.id);
    this.productArray = response.data;
    console.log("coucou", this.productArray);
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.id = getUser.data.id;
  },
  methods: {
    order() {
      this.$router.push("/commander");
    },
    edit() {
      this.$router.push("/catalogue/" + this.$route.params.id + "/modifier");
    },
  },
};
</script>

<style>
</style>
