<!--
-- Company home page component
-->

<template>
  <div class="d-flex justify-content-center flex-wrap mt-3">
    <!-- Members card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Membres</h5>
        <p class="card-text">
          Gérer les membres qui peuvent accéder à des services et produits.
        </p>
        <a @click="showMembers" class="card-link">Voir</a>
        <a @click="memberAdd" class="card-link">Ajouter</a>
      </div>
    </div>

    <!-- Profile card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">Voir et modifier vos détails.</p>
        <a class="card-link">Voir</a>
      </div>
    </div>

    <!-- Orders card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Commandes</h5>
        <p class="card-text">Les commandes en cours, en attente et terminés.</p>
        <a @click="orderList" class="card-link">Voir</a>
      </div>
    </div>

    <!-- News card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Actualités</h5>
        <p class="card-text">Vos actualités personalisées.</p>
        <a @click="news" class="card-link">Voir</a>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "CompanyHome",
  components: {
    Header,
  },
  methods: {
    profile() {
      this.$router.push({ name: "CompanyDisplay", params: { id: this.id } });
    },
    orderList() {
      this.$router.push({ name: "orders" });
    },
    memberAdd() {
      this.$router.push({ name: "companiesAddMembers" });
    },
    showMembers() {
      this.$router.push({ name: "companiesMembers" });
    },
    news() {
      this.$router.push({ name: "adminNews" });
    },
  },
};
</script>

<style>
</style>