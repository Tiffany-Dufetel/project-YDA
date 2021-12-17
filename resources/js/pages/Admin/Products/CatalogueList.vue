<!--
-- View catalogue page component
-->

<template>
  <div class="catalogue_container">
    <Header title="Catalogue" subtitle="Produits et services" />
    <BackButton />
    <AddButton name="Ajouter Produit" @click="add" />

    <br />

    <!-- Search box -->
    <form class="form-inline">
      <input
        class="form-control mr-sm-2"
        type="search"
        placeholder="Search"
        aria-label="Search"
      />
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">
        Search
      </button>
    </form>

    <!-- Companies list -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>type</th>
          <th>Catégorie</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in productArray" :key="index">
          <td valign="middle">
            <router-link
              :to="{ name: 'individualProduct', params: { id: product.id } }"
              >{{ product.name }}</router-link
            >
          </td>
          <td valign="middle">{{ product.description }}</td>
          <td valign="middle">{{ product.type }}</td>
          <td valign="middle">{{ product.category }}</td>
          <td valign="middle">
            <img :src="product.image" class="image_product" />
          </td>

          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualProduct', params: { id: product.id } }"
                class="btn btn-primary"
                >Edit
              </router-link>
              <button class="btn btn-danger" @click="deleteProduct(product.id)">
                Delete
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import CatalogueDisplay from "../../../components/ui/catalogue/CatalogueDisplay.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import AddButton from "../../../components/ui/buttons/AddButton.vue";

export default {
  name: "productList",
  components: {
    Header,
    CatalogueDisplay,
    BackButton,
    AddButton,
  },

  inject: ["checkRole", "whatRole"],

  data() {
    return {
      productArray: [],
      role : "",
    };
  },

  async mounted() {
    const getProducts = await axios.get("/api/product");
    this.productArray = getProducts.data.data;

    console.log("product", this.productArray);
    console.log("store",this.$store)
  },

//   async beforeCreate(){

//     const getUser = await axios.get("/api/login");
//     this.role = getUser.data.role;
//     console.log("role", this.role);

//     if (this.role == "manager"){
//         this.$router.push('/admin')
//     }
    // this.id = getUser.data.id;
//   },

  methods: {
    add() {
      this.$router.push({ name: "adminProductAdd" });
    },
  },
};
</script>

<style>
.image_product {
  height: 50px;
}
</style>
