<!--
-- View catalogue page component
-->

<template>
  <div class="catalogue_container">
    <Header title="Catalogue" subtitle="Liste des produits et services" />
    <BackButton />
    <div v-if="role == 'admin'">
      <AddButton name="Ajouter Produit" @click="add" />
    </div>
    <br />

    <!-- Search box -->
    <input
      id="input-search"
      v-model="searchKeyCatalogue"
      class="form-control mr-sm-2"
      type="text"
      placeholder="Rechercher...."
      aria-label="Search"
      autocomplete="off"
    />
    <br />
    <div class="search-result">
      <span v-if="searchKeyCatalogue && filteredListCatalogue.length == 1">
        {{ filteredListCatalogue.length }} résultat(s)</span
      >
      <span v-if="filteredListCatalogue.length >= 2"></span>
    </div>

    <div class="search-result" v-if="filteredListCatalogue.length == 0">
        <h3>Désolé</h3>
        <p>Aucun résultat trouvé</p>
    </div>

    <!-- Companies list -->
    <table class="center-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>type</th>
          <th>Catégorie</th>
          <th>Image</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="product in filteredListCatalogue" :key="product.id">
                    <td valign="middle">{{ product.name }}</td>
                    <td valign="middle">{{ product.description }}</td>
                    <td valign="middle">{{ product.type }}</td>
                    <td valign="middle">{{ product.category }}</td>
                    <td valign="middle"><img :src="product.image" class="image_product" /></td>
                    <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualProduct', params: { id: product.id } }"
                class="btn-show"
                >Voir
              </router-link>
              <div v-if="role == 'admin'">

                <button
                  class="btn-delete"
                  @click="deleteProduct(product.id)"
                >
                  <ion-icon name="trash"></ion-icon>
                </button>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
// import OrderDisplay from "../../../components/ui/orders/OrderDisplay.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import AddButton from "../../../components/ui/buttons/AddButton.vue";

export default {
  name: "productList",
  components: {
    Header,
    // OrderDisplay,
    BackButton,
    AddButton,
  },

  inject: ["checkRole", "whatRole"],
  data() {
    return {
      link: "/",
      productArray: [],
      product: null,
      role: "",
      searchKeyCatalogue: "",
    };
  },
async mounted() {
    const getProducts = await axios.get("/api/product");
    this.productArray = getProducts.data.data;


  },
  computed: {
    /** Search box */
    filteredListCatalogue() {
      return this.productArray.filter((product) => {
        return (
          product.name.toLowerCase().includes(this.searchKeyCatalogue.toLowerCase()) ||
          product.type.toLowerCase().includes(this.searchKeyCatalogue.toLowerCase()) ||
          product.category.toLowerCase().includes(this.searchKeyCatalogue.toLowerCase())
        );
      });
    }
  },
  methods: {
    displayCompany(){
        console.log()
        // this.$router.push("/catalogue" + id)
    },
    /** Go to "add new item" page */
    add() {
      this.$router.push({ name: "adminProductAdd" });
    },
    /** Retrieve full list of companies from database */
    async retrieveProducts() {
      const getProducts = await axios.get("/api/product");
      this.productArray = getProducts.data.data;
      console.log("product", this.products);
      console.log("store", this.$store);
    },
    /** Refresh the list when changes are made */
    async refreshList() {
      this.retrieveProducts();
      this.product = null;
    },
    /** Delete a specific company */
    deleteProduct(id) {
      if (confirm("Etes-vous sur d'effacer cette produit ou service ?")) {
        axios
          .delete(`api/product/${id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => this.refreshList());
      }
    },
  },
  async mounted() {
    this.retrieveProducts();
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.id = getUser.data.id;
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
};
</script>

<style>
.image_product {
  height: 50px;
}

.center-table{
  margin-left: auto;
  margin-right: auto;
  margin-right: 30px;
}

table{
    background-color: white;
    border-collapse: collapse;
    border-radius: 1em;
    overflow: hidden;
    width: auto;
    margin-bottom: 30px;
}

th, td {
  padding: 10px 25px;
  width: 230px;
}

/* td{
    cursor:pointer;
}

tr:hover{
    -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
    box-shadow: 1px 1px 15px 1px #dddddd;
} */

tbody tr:nth-child(odd) {
    background-color: #f5f5f5;
}

thead{
    background-color: #e78c15!important;
    padding: 30px;
    color: white;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-radius: 20px;
}

.btn-show{
    background-color: white;
    padding: 8px 20px 5px 20px;
    border-radius: 5px;
    border: 2px solid #e78c15;
    color: #e78c15;
}
.btn-show:hover{
    color: black;
        border: 2px solid black;
}

.btn-delete{
    border: none;
    background-color: transparent;
        padding: 8px 4px 5px 4px;

}
#input-search{
    background-image: url('https://www.freeiconspng.com/thumbs/search-icon-png/search-icon-png-8.png');
    background-size: 40px;
    background-repeat: no-repeat;
    background-position: right center;
    padding: 10px 20px;
    border-radius: 10px;
    width: 40vh;
    margin-right: auto;
    margin-left: auto;
}

.search-result{
    text-align: center;
}
</style>
