<!--
-- Member individual display page component
-->

<template>
            <Header/><br />
  <div class="container">
    <!-- rendre le nom reactive -->
    <div v-for="(info, index) in userInfo" :key="index">

      <BackButton />

      <!-- Catalogue card -->
      <!-- <div class="d-flex justify-content-center flex-wrap mt-3">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <h5 class="card-title">Catalogue</h5>
            <p class="card-text">Les produits et services disponible.</p>
            <a @click="catView" class="card-link">Voir</a>
            <a @click="order" class="card-link">Commandez</a>
          </div>
        </div>
      </div> -->

      <!-- Profile -->
    <div class="info-user-container">
        <div class="info-user">
          <h3>{{ info.first_name }} {{ info.surname.toUpperCase() }}</h3>
          <u>Prénom:</u> {{ info.first_name }}<br />
          <u>Nom:</u> {{ info.surname.toUpperCase() }}<br />
          <u>Email:</u> {{ info.email }}<br />
          <u>Date de naissance:</u> {{ info.birthday }}<br /><br />

                          <i>
          Si vous voulez modifier votre profil, veuillez contacter votre
          gestionnaire.
        </i>
        </div>

      </div>
      <p>

      </p>
    </div>
    <br /><br />

<div class="orders-container">
    <!-- List of orders -->
    <center><h1>Mes commandes</h1></center>
    <!-- <input
      v-model="searchKeyMembre"
      class="form-control mr-sm-2"
      type="search"
      placeholder="Rechercher...."
      aria-label="Search"
      autocomplete="off"
    /> -->
    <br />
    <table id="table_margin" class="center-table">
      <thead>
        <tr>
          <th>Commande</th>
          <th>Date de commande</th>
          <th>Date de livraison</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orderArray" :key="order.id">
          <td valign="middle">{{ order.product.name }}</td>
          <td valign="middle">{{ order.date_order }}</td>
          <td valign="middle">{{ order.date_delivery }}</td>
          <td valign="middle">{{ order.status }}</td>
          <td valign="middle">
            <div class="btn-group" role="group">
              <div v-if="order.status == 'en attente'">
                <button
                  @click="deleteOrder(order.product.id)"
                  class="btn-delete"
                >
                    <ion-icon name="trash"></ion-icon>
                </button>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
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

      const response = await axios.get("/api/user/" + this.$route.params.id);
      this.orderArray = response.data;
      console.log("order array", this.orderArray);

      const responseUser = await axios.get("/api/info/" + this.$route.params.id);
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
.info-user-container{
    display: flex;
    justify-content: center;
    border: none;
    -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
    box-shadow: 1px 1px 15px 1px #dddddd;
    margin: 10px;
    padding: 33px;
    border-radius: 15px;
    background-color: white;
    height: 277px;
    width: 487px;
}
/*
.info-user{
    display: flex;
    justify-content: center;
    flex-direction: column;
} */
</style>
