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
      </div>
    </div>

    <!-- Orders card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Commandes</h5>
        <p class="card-text">Vos commandes en cours, en attente et terminés.</p>
        <a @click="orderList" class="card-link">Voir</a>
      </div>
    </div>

    <!-- Order request card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Commandez</h5>
        <p class="card-text">Commandez ici !</p>
        <a @click="order" class="card-link">On y va !</a>
      </div>
    </div>

    <!-- Profile card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">Voir et modifier vos détails.</p>
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
      this.$router.push({ name: "individualMember", params: { id: this.id } });
    },
    orderList() {
      this.$router.push({ name: "orders" });
    },
  },
};
</script>

<style>
</style>