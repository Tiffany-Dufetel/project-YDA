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
          Voir les membres qui peuvent accéder à des services et produits.
        </p>
        <a @click="showMembers" class="card-link">Voir</a>
      </div>
    </div>

    <!-- Profile card -->
    <div class="card" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Profil</h5>
        <p class="card-text">
          Voir et modifier vos détails et ajouter les membres.
        </p>
        <a @click="profile" class="card-link">Voir</a>
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
      this.$router.push("/entreprise/" + this.company_id);
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
  async mounted() {
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.id = getUser.data.id;
    console.log("ID", this.id);
    // Loading of company information
    const getCompany = await axios.get("/api/company" + this.id);
    this.company = getCompany.data.role;
    console.log("company:", this.company);
  },
};
</script>

<style>
</style>