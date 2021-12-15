<!--
-- Product order form page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="Commandez ici " subtitle="Nous vous contacterons en suite" />
    <BackButton />
    <div class="d-flex justify-content-center">
      <form method="POST" @submit.prevent="addOrder">
        <!-- product/service choice -->
        <div class="form-group col-md-4">
          <label for="name">Choisir votre service ou </label>
          <select
            v-model="name"
            name="name"
            id="name"
            class="form-control"
            required="true"
          >
            <option value="{{ product.id }}">
              <div v-for="product in productArray" :key="product.id">
                {{ product.id }} - {{ product.name }}
              </div>
            </option>
          </select>
        </div>

        <!-- comment - preferred delivery dates -->
        <div class="form-group col-md-4">
          <label for="comment"
            >Veuillez nous définir le jour que vous préferez</label
          >
          <p>A priori, nous passons à votre entreprise le jeudi ou vendredi.</p>

          <input
            type="date"
            id="date_delivery"
            name="date_delivery"
            v-model="date_delivery"
            min="2022-01-01"
            max="2022-12-31"
          />
        </div>
        <SubmitButton name="Envoyer demande" />
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";

export default {
  name: "productOrder",
  components: {
    Header,
    BackButton,
    SubmitButton,
  },
  data() {
    return {
      product_id: "",
      date_delivery: "",
      productArray: [],
    };
  },
  // fetch the list of products on view creation
  async mounted() {
    const getProduct = await axios.get("/api/product");
    this.productArray = getProduct.data.data;
  },
  methods: {
    addOrder() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/order", {
            status: this.status,
            product_id: this.product_id,
            date_delivery: this.date_delivery,
          })
          .then((response) => {
            console.log(response);
            this.$router.push({ name: "orders" });
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
