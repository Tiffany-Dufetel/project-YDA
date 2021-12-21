<!--
-- Member individual display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <div v-for="(info, index) in userInfo" :key="index">
      <!--       <Header
        :title="info.company.name"
        subtitle="Votre page de profil"
      /><br /> -->
      <BackButton />

      <!-- Catalogue card -->
      <div class="d-flex justify-content-center flex-wrap mt-3">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <h5 class="card-title">Catalogue</h5>
            <p class="card-text">Les produits et services disponible.</p>
            <a @click="catView" class="card-link">Voir</a>
            <a @click="order" class="card-link">Commandez</a>
          </div>
        </div>
      </div>

      <!-- Profile -->
      <div class="d-flex justify-content-center">
        <div class="center col-md-5 user_info_container">
          <h3>{{ info.first_name }} {{ info.surname.toUpperCase() }}</h3>
          <u>Prénom:</u> {{ info.first_name }}<br />
          <u>Nom:</u> {{ info.surname.toUpperCase() }}<br />
          <u>Email:</u> {{ info.email }}<br />
          <u>Date de naissance:</u> {{ info.birthday }}<br /><br />
        </div>
      </div>
      <p>
        <i>
          Si vous voulez modifier votre profil, veuillez contacter votre
          gestionnaire.
        </i>
      </p>
    </div>
    <br /><br />

    <!-- List of orders -->
    <center><h1>Mes commandes</h1></center>
    <table id="table_margin" class="table table-bordered">
      <thead>
        <tr>
          <th>Commande</th>
          <th>Date de commande</th>
          <th>Date de livraison</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orderArray" :key="order.id">
          <td>{{ order.product.name }}</td>
          <td>{{ order.date_order }}</td>
          <td>{{ order.date_delivery }}</td>
          <td>{{ order.status }}</td>
          <td>
            <div class="btn-group" role="group">
              <div v-if="order.status == 'en attente'">
                <button
                  @click="deleteOrder(order.product.id)"
                  class="btn btn-danger"
                >
                  Delete
                </button>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import AddButton from "../../components/ui/buttons/AddButton.vue";

export default {
  name: "MemberDisplay",
  components: {
    Header,
    BackButton,
    AddButton,
  },

  data() {
    return {
      userInfo: [],
      orderArray: [],
      commande: null,
    };
  },

  methods: {
    /** Retrieve full list of orders and member info from database */
    async retrieveDashboard() {
      const getUser = await axios.get("/api/login");
      this.id = getUser.data.id;
      console.log("ID", this.id);

      const response = await axios.get("/api/user/" + this.id);
      this.orderArray = response.data;
      console.log("order array", this.orderArray);

      const responseUser = await axios.get("/api/info/" + this.id);
      this.userInfo = responseUser.data;
      console.log(this.userInfo);
    },
    /** Refresh the list when changes are made */
    async refreshList() {
      this.retrieveDashboard();
      this.commande = null;
    },
    /** Order product link */
    add() {
      this.$router.push({ name: "productOrder" });
    },
    catView() {
      this.$router.push({ name: "adminCatalogue" });
    },
    order() {
      this.$router.push({ name: "productOrder" });
    },
    /** Delete a specific company */
    deleteOrder(order_id) {
      if (confirm("Etes-vous sur d'effacer cette commande ?")) {
        axios
          .delete(`http://127.0.0.1:8000/api/order/${order_id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => this.refreshList());
      }
    },
  },
  mounted() {
    this.retrieveDashboard();
  },
};
</script>

<style>
/* .user_info_container{
    border: 5px solid black;
    border-radius: 10px;
    padding: 20px;
}

.log {
  background-color: #e78c15;
  border-radius: 5px;
  padding: 5px 20px;
  border: 1px solid #e78c15;
  color: white;
}

.table_margin{
    margin-bottom: 500px !important;
} */
</style>
