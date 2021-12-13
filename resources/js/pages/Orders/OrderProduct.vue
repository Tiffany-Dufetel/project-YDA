<!--
-- Product order form page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="Commandez ici " subtitle="Nous vous contacterons en suite" />
    <div class="d-flex justify-content-center">
      <form @submit.prevent="addOrder">
        <!-- product/service choice -->
        <div class="form-group col-md-4">
          <label for="products_id">Choisir votre service ou </label>
          <select
            v-model="products_id"
            name="products_id"
            id="products_id"
            class="form-control"
            required="true"
          >
            <option value="2">
              <div v-for="product in productArray" :key="product.id">
                {{ product.name }}
              </div>
            </option>
            <!-- <option value="1">1 - 6 bouteilles de vin</option>
            <option value="2">2 - Pressing</option>
            <option value="3">2 - Pressing</option> -->
          </select>
        </div>

        <!-- comment - preferred delivery dates -->
        <div class="form-group col-md-4">
          <label for="comment"
            >Veuillez nous définir les jours que vous préferez</label
          >
          <p>
            Nous vous contacterons en suite pour confirmer les disponibilités
          </p>
          <textarea
            rows="4"
            cols="50"
            type="text"
            name="comment"
            v-model="comment"
            placeholder="vos préférences de jours"
            required="true"
          >
          </textarea>
        </div>
        <SubmitButton name="Envoyer demande" @click="addOrder" />
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  components: {
    Header,
    SubmitButton,
  },
  data() {
    return {
      status: "en attente",
      products_id: "",
      comment: "",
      productArray: [],
    };
  },
  // fetch the list of products on view creation using sanctum in axios
  async mounted() {
    const getProduct = await axios.get("/api/product");

    this.productArray = getProduct.data.data;
  },

  /* created() {
    axios.get("/sanctum/csrf-cookie").then((response) => {
      axios
        .get("/api/product")
        .then((response) => {
          this.product = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    });
  }, */
  methods: {
    addOrder() {
      axios
        .post("/api/order/store")
        .then(function (response) {
          alert(response.data);
        })
        .catch(function (error) {
          alert(error);
        });
    },
  },
};
</script>

<style>
</style>
