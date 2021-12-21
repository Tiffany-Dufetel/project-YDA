<!--
-- Member home page component
-->

<template>
  <div class="d-flex justify-content-center flex-wrap mt-3">
    <!-- Catalogue card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Catalogue</h5>
        <p class="card-text">Les produits et services disponible.</p>
        <a @click="catView" class="card-link">Voir</a>
        <a @click="order" class="card-link">Commandez</a>
      </div>
    </div>

    <!-- Profile card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">Voir et modifier vos détails et commandes.</p>
        <a @click="profile" class="card-link">Voir</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MemberHome",
  methods: {
    catView() {
      this.$router.push({ name: "adminCatalogue" });
    },
    order() {
      this.$router.push({ name: "productOrder" });
    },
    profile() {
      this.$router.push("/membre/" + this.id);
    },
    orderList() {
      this.$router.push({ name: "orders" });
    },
    add() {
      this.$router.push({ name: "productOrder" });
    },
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
  async mounted() {
    // Loading of users' information
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.id = getUser.data.id;
    console.log("ID", this.id);

    const response = await axios.get("/api/user/" + this.$route.params.id);
    this.orderArray = response.data;
    console.log("order array", this.orderArray);

    const responseUser = await axios.get("/api/info/" + this.$route.params.id);
    this.userInfo = responseUser.data;
    console.log(this.userInfo);
  },
};
</script>

<style>
</style>