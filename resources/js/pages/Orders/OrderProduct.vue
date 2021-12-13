<!--
-- Product order form page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="Commandez ici " subtitle="Nous vous contacterons en suite" />
    <div class="d-flex justify-content-center">
      <form @submit.prevent="addOrder">
        <!-- item name -->
        <div class="form-group col-md-4">

        <!-- product/service choice -->
        <div class="form-group col-md-4">
          <label for="products_id">Choisir votre service ou </label>
          <select
            v-model="products_id"
            name="products_id"
            id="products_id"
            class="form-control"
            required="true"
            multiple
          >
            <option selected>Choisir votre/vos commande(s)</option>
            <option v-for="product in product" :key="product" :value="product.id" >
              {{ product.name }}
            </option>
            <!-- <option value="1">1 - 6 bouteilles de vin</option>
            <option value="2">2 - Pressing</option>
            <option value="3">2 - Pressing</option> -->
          </select>
        </div>

        <!-- comment - preferred delivery dates -->
        <div class="form-group col-md-4">
          <label for="comment"
            >Veuillez nous définir les jours que cous préferez</label
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
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "ProductOrder",
  components: {
    Header,
    SubmitButton,
  },
  data() {
    return {
      products_id: "",
      comment: "",
      data: {},
      product: [],
    };
  },
  // fetch the list of products on view creation using sanctum in axios
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get("/api/product")
        .then((response) => {
          this.product = response.data;
        })
        .catch(function (error) {
          console.error(error);
        });
    });
  },
  methods: {
    addOrder() {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post("/api/order/store", this.order)
          .then((response) => {
            this.$router.push({ name: "order" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
</style>