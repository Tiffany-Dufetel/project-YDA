<!--
-- Add product page component
-->

<template>
    <Header title="Ajouter un produit ou service" subtitle="...." />
    <BackButton />
        <div class="alert alert-success" v-show="success">Votre produit a bien été rajouté</div>
        <div class="d-flex justify-content-center">
            <form>
                <div class="form-group col-md-10">
                    <label for="name">Nom</label>
                    <input
                        v-model="formData.name"
                        id="name"
                        type="text"
                        name="name"
                        required autocomplete="name"
                        autofocus>
                </div>

                <div v-show="errors && errors.name">
                    <p class="text-danger" v-for="(error, index) in errors.name" :key="index" >{{error}}</p>
                </div>

                <div class="form-group col-md-10">
                    <label for="description">Description</label>
                    <input
                        v-model="formData.description"
                        id="description"
                        type="text"
                        name="description"
                        required autocomplete="on">
                </div>

                <div v-show="errors && errors.description">
                    <p class="text-danger" v-for="(error, index) in errors.description" :key="index" >{{error}}</p>
                </div>

                <div class="form-group col-md-10">
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

                <div v-show="errors && errors.type">
                    <p class="text-danger" v-for="(error, index) in errors.type" :key="index" >{{error}}</p>
                </div>

                <div class="form-group col-md-10">
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

                <div v-show="errors && errors.category">
                    <p class="text-danger" v-for="(error, index) in errors.category" :key="index" >{{error}}</p>
                </div>

                <div class="form-group col-md-10">
                    <label>Image</label>
                        <!-- MOST IMPORTANT - SEE "ref" AND "@change" PROPERTIES -->
                        <input type="file" class="custom-file-input" id="customFile"
                            ref="file" @change="handleFileObject()">
                </div>

                <div v-show="errors && errors.image">
                    <p class="text-danger" v-for="(error, index) in errors.image" :key="index" >{{error}}</p>
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
        formData:{},
        image:null,
        success: false,
        errors: {},
    };
  },
  methods: {
      submit(event){
          event.preventDefault()
          let formData = new FormData()
          formData.append('image', this.image)

          _.each(this.formData, (value, key) => {
              formData.append(key, value)
          })

        const response = axios.post('api/product', formData)
            .then(res =>{

                this.formData = {}
                this.$refs.file.value = null
                this.success = true
            }).catch(error=>{
                if (error.response.status == 422 ){
                    this.errors = error.response.data.errors
                }
                console.log(this.errors)
            })
        // this.$router.push('/catalogue')
      },

    handleFileObject() {
        this.image = this.$refs.file.files[0]
    }
  },
};
</script>

<style scoped>
input, select{
    width: 25vh;
}
</style>
