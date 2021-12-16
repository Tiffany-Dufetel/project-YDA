<!--
-- Add product page component
-->

<template>
    <Header title="Ajouter un produit ou service" subtitle="...." />
    <BackButton />

        <div class="d-flex justify-content-center">
            <form>
                <div class="form-group col-md-4">
                    <label for="name">Nom</label>
                    <input
                        v-model="formData.name"
                        id="name"
                        type="text"
                        name="name"
                        required autocomplete="name"
                        autofocus>
                </div>

                <div class="form-group col-md-4">
                    <label for="description">Description</label>
                    <input
                        v-model="formData.description"
                        id="description"
                        type="text"
                        name="description"
                        required autocomplete="on">
                </div>

                <div class="form-group col-md-4">
                    <label for="type">Type</label>
                        <select
                            v-model="formData.type"
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

                <div class="form-group col-md-4">
                    <label for="category">Categorie</label>
                        <select
                            v-model="formData.category"
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

                <div class="form-group col-md-4">
                    <label>Image</label>
                        <!-- MOST IMPORTANT - SEE "ref" AND "@change" PROPERTIES -->
                        <input type="file" class="custom-file-input" id="customFile"
                            ref="file" @change="handleFileObject()">
                </div>
                  <SubmitButton  @click="submit" name="Ajouter"/>
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
        formData:{
            name: null,
            description: null,
            type: null,
            category: null,
        },
        image:null,
    };
  },
  methods: {
      submit(){
          let formData = new FormData()
          formData.append('image', this.image)

          _.each(this.formData, (value, key) => {
              formData.append(key, value)
          })

          axios.post('api/product', formData,{
              headers: {
                'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
             }
          })
        this.$router.push('/catalogue')
      },

    handleFileObject() {
        this.image = this.$refs.file.files[0]
    }
  },
};
</script>
