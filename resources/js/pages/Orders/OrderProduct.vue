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
          <label for="name">Choisir votre service ou </label>
          <select
            v-model="name"
            name="name"
            id="name"
            class="form-control"
            required="true"
          >
            <option value="{{ product.name }}">
              <div v-for="product in productArray" :key="product.id">
                {{ product.name }}
              </div>
            </option>
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

export default {
  name: "productOrder",
  components: {
    Header,
    SubmitButton,
  },
  data() {
    return {
      status: "en attente",
      name: "",
      date_delivery: "",
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
    addCompany() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/order", {
            status: this.status,
            name: this.name,
            date_delivery: this.date_delivery,
            id: this.id,
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
