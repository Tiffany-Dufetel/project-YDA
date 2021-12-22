<!--
-- View company update page component
BACK BUTTON
-->

<template>
  <div>
    <Header title="Modifier votre produit ou service" subtitle="update " />
    <BackButton />

    <!-- <h2>{{ product.name }}</h2> -->
    <div class="alert alert-success" v-show="success">
      Votre item a bien été mis à jour
    </div>
    <form method="POST" @submit.prevent>
      <div class="form-group col-md-10">
        <label for="name">Nom</label>

        <input
          v-model="productInfo.name"
          id="name"
          type="text"
          name="name"
          required
          autocomplete="name"
          autofocus
        />
      </div>

      <div v-show="errors && errors.name">
        <p
          class="text-danger"
          v-for="(error, index) in errors.name"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <div class="form-group col-md-10">
        <label for="description">Description</label>
        <input
          v-model="productInfo.description"
          id="description"
          type="text"
          name="description"
          required
          autocomplete="on"
        />
      </div>

      <div v-show="errors && errors.description">
        <p
          class="text-danger"
          v-for="(error, index) in errors.description"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <div class="form-group col-md-10">
        <label for="type">Type</label>
        <select
          v-model="productInfo.type"
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

      <div v-show="errors && errors.type">
        <p
          class="text-danger"
          v-for="(error, index) in errors.type"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <div class="form-group col-md-10">
        <label for="category">Categorie</label>
        <select
          v-model="productInfo.category"
          name="category"
          id="category"
          class="form-control"
          required="true"
        >
          <option selected>choisir la catégorie...</option>
          <option value="nourriture">nourriture</option>
          <option value="boissons">boisson</option>
          <option value="bien-être">bien-être</option>
          <option value="maison">maison</option>
          <option value="quotidien">quotidien</option>
          <option value="coffret">coffret</option>
        </select>
      </div>

      <div v-show="errors && errors.category">
        <p
          class="text-danger"
          v-for="(error, index) in errors.category"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <div class="form-group col-md-10">
        <label>Image</label>
        <!-- MOST IMPORTANT - SEE "ref" AND "@change" PROPERTIES -->
        <input
          type="file"
          class="custom-file-input"
          id="customFile"
          ref="file"
          @change="handleFileObject()"
        />
      </div>

      <div v-show="errors && errors.image">
        <p
          class="text-danger"
          v-for="(error, index) in errors.image"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <SubmitButton @click="productUpdate" name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import SubmitButton from "../../../components/ui/buttons/SubmitButton.vue";
export default {
  name: "itemUpdate",
  components: {
    Header,
    SubmitButton,
  },

  data() {
    return {
      productInfo: {},
    //   image: null,
      success: false,
      errors: {},
    };
  },

  methods: {
    productUpdate() {
    //   event.preventDefault();
    //   let formData = new FormData();
    //   formData.append("image", this.image);

    //   _.each(this.formData, (value, key) => {
    //     formData.append(key, value);
    //   });

      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .put("/api/product/" + this.$route.params.id, this.productInfo,{
          })
          .then((res) => {
            this.success = true;
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
      });
    },

    handleFileObject() {
      this.image = this.$refs.file.files[0];
    },
  },

  async mounted() {
    const response = await axios.get("/api/product/" + this.$route.params.id);
    this.productInfo = response.data;
    console.log('chiroahroa', this.productInfo)
  },
};
</script>

<style>
</style>
