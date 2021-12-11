<!--
-- Add product page component
-->

<template>
  <div>
    <Header title="Ajouter un produit ou service" subtitle="...." />
    <div class="d-flex justify-content-center">
      <form action="post" @submit.prevent="addProduct">
        <!-- item name -->
        <div class="form-group col-md-4">
          <input
            type="text"
            name="name"
            v-model="name"
            placeholder="nom de produit"
          />
        </div>
        <!-- item description -->
        <div class="form-group col-md-4">
          <textarea
            rows="4"
            cols="50"
            type="text"
            name="description"
            v-model="description"
            placeholder="descriptif du produit"
            required="true"
          >
          </textarea>
        </div>
        <!-- item type -->
        <div class="form-group col-md-4">
          <label for="type">Type</label>
          <select
            v-model="type"
            name="type"
            id="type"
            class="form-control"
            required="true"
          >
            <option selected>choisir le type...</option>
            <option value="service">service</option>
            <option value="produit">produit</option>
          </select>
        </div>
        <!-- item type -->
        <div class="form-group col-md-4">
          <label for="category">Categorie</label>
          <select
            v-model="category"
            name="category"
            id="category"
            class="form-control"
            required="true"
          >
            <option selected>choisir la catégorie...</option>
            <option value="service">service</option>
            <option value="produit">produit</option>
          </select>
        </div>

        <input type="submit" class="button is-info" value="Ajouter" />
      </form>
    </div>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "AddProduct",
  components: {
    Header,
  },
  data() {
    return {
      name: "",
      description: "",
      type: "",
      category: "",
      data: {},
    };
  },
  methods: {
    async addProduct(event) {
      event.target.reset();
      const createProduct = JSON.stringify(
        this.name,
        this.description,
        this.type,
        this.category
      );
      // create post bosy
      const product = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: createProduct,
      };
      console.log(createProduct);
      // fetch to backend
      const response = await axios.post("/api/product", product);
      /// might need rest.JSON?? Look if it arrives on back end
      const data = await response.json();
      // data declarations
      this.name = data.name;
      this.description = data.description;
      this.type = data.type;
      this.category = data.category;
    },
  },
};
</script>
