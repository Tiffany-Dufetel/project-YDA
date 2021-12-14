<!--
-- Add product page component
-->

<template>
  <div>
    <Header title="Ajouter un produit ou service" subtitle="...." />
    <BackButton />
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

        <SubmitButton name="Ajouter" />
      </form>
    </div>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import BackButton from "../../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../../components/ui/buttons/SubmitButton.vue";
import axios from "axios";

export default {
  name: "AddProduct",
  components: {
    Header,
    BackButton,
    SubmitButton,
  },
  data() {
    return {
      name: "",
      description: "",
      image: "",
      type: "",
      category: "",
      data: {},
    };
  },
  methods: {
    addOrder() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/product", {
            name: this.name,
            description: this.description,
            image: this.image,
            type: this.type,
            category: this.category,
          })
          .then((response) => {
            this.$router.push({ name: "product" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>
