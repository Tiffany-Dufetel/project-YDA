<!--
-- Add product page component
-->

<template>
  <Header title="Ajouter un produit ou service" subtitle="" />
  <BackButton />
  <div class="alert alert-success" v-show="success">
    Votre produit a bien été rajouté
  </div>
  <div class="container">
    <form class="formContent">
      <div>
        <label for="name">Nom</label><br>
        <input
          v-model="formData.name"
          id="name"
          type="text"
          name="name"
          required
          autocomplete="name"
          class="inputText marginBot"
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

      <div >
        <label for="description">Description</label><br>
        <input
          v-model="formData.description"
          id="description"
          type="text"
          name="description"
          required
          class="inputText marginBot"
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

      <div>
        <label for="type">Type</label><br>
        <select
          v-model="formData.type"
          name="type"
          id="type"
          class="inputText marginBot"
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

      <div>
        <label for="category">Categorie</label><br>
        <select
          v-model="formData.category"
          name="category"
          class="inputText marginBot"
          id="category"
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

      <div>
        <label>Image</label><br>
        <!-- MOST IMPORTANT - SEE "ref" AND "@change" PROPERTIES -->
        <input
          type="file"
          class="inputFile"
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

      <SubmitButton class="marginTop" @click="submit" name="Ajouter" />
    </form>
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
      formData: {},
      image: null,
      success: false,
      errors: {},
    };
  },
  methods: {
    submit(event) {
      event.preventDefault();
      let formData = new FormData();
      formData.append("image", this.image);

      _.each(this.formData, (value, key) => {
        formData.append(key, value);
      });

      const response = axios
        .post("api/product", formData)
        .then((res) => {
          this.formData = {};
          this.$refs.file.value = null;
          this.success = true;
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log(this.errors);
        });
      // this.$router.push('/catalogue')
    },

    handleFileObject() {
      this.image = this.$refs.file.files[0];
    },
  },
};
</script>

<style>
input,
select {
  width: 25vh;
}
.container{
    display: flex;
    justify-content: center;
}

.formContent{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    letter-spacing: 3px;
    font-size:17px;
    border: 1px solid transparent;
    border-radius: 10px;
    width: 450px;
    -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
    box-shadow: 1px 1px 15px 1px #dddddd;
    padding: 50px;

}

.marginTop{
    margin-top: 15px;
}

.marginBot{
    margin-bottom: 15px;
}

.inputText{
    border-radius: 10px;
    height: 2.5rem;
    outline: none;
    border: 1px solid black;
    width: 350px;
    color: #333333;
    padding-left: 10px;
}

.inputText:focus{
    border: 2px solid #e78c15;
    background-color: #fafafa;
}

.inputFile{
    width: 350px;
}

</style>
