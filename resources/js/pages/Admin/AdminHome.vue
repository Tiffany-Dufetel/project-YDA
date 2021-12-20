<!--
-- Admin home page component
-->

<template>
  <div v-if="role == 'admin'">
    <Header
      title="Bienvenue à votre page administration"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <div class="d-flex justify-content-center flex-wrap mt-3">
      <!-- Catalogue card -->
      <div class="card" style="width: 18rem">
        <div class="card-body">
          <h5 class="card-title">Catalogue</h5>
          <p class="card-text">Vos produits et services.</p>
          <a @click="catView" class="card-link">Voir</a>
          <a @click="catAdd" class="card-link">Ajouter</a>
        </div>
      </div>

      <!-- Companies card -->
      <div class="card" style="width: 18rem">
        <div class="card-body">
          <h5 class="card-title">Entreprises</h5>
          <p class="card-text">
            Tous les entreprises actuellement actives sur YDA.
          </p>
          <a @click="companyView" class="card-link">Voir</a>
          <a @click="companyAdd" class="card-link">Ajouter</a>
        </div>
      </div>

      <!-- Orders card -->
      <div class="card" style="width: 18rem">
        <div class="card-body">
          <h5 class="card-title">Commandes</h5>
          <p class="card-text">
            Les commandes en cours, en attente et terminés.
          </p>
          <a @click="orderList" class="card-link">Voir</a>
        </div>
      </div>

      <!-- News card -->
      <div class="card" style="width: 18rem">
        <div class="card-body">
          <h5 class="card-title">Actualités</h5>
          <p class="card-text">
            Les actualités que vous avez ajoutés pour les entreprises.
          </p>
          <a @click="news" class="card-link">Voir</a>
          <a @click="newsAdd" class="card-link">Ajouter</a>
        </div>
      </div>
    </div>
    <!-- Calendar displaying upcoming events -->
    <!--     <Calendar /> -->
    <CalendarTwo />
  </div>

  <div v-else-if="role == 'manager'">
    <Header
      title="Bienvenue à votre page de manager"
      subtitle="Gérer vos membres"
    />
    <div class="mt-5">
      <button @click="showMembers">Liste des membres</button>
    </div>
  </div>

  <div v-else-if="role == 'member'">
    <Header
      title="Bienvenue à votre page de membre"
      subtitle="Passez vos commandes"
    />
    <div class="mt-5">
      <button @click="catView">Voir Catalogue</button>
      <button @click="order">Commander</button>
      <button @click="profile">Mon profile</button>
    </div>
  </div>

  <div v-else></div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import axios from "axios";
import Calendar from "../../components/ui/admin/Calendar.vue";
import CalendarTwo from "../../components/ui/admin/CalendarTwo.vue";

export default {
  name: "AdminHome",
  components: {
    Header,
    Calendar,
    CalendarTwo,
  },

  data() {
    return {
      productArray: [],
      role: "",
      id: "",
    };
  },
  async mounted() {
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.id = getUser.data.id;
    // console.log("user", this.id);
  },

  methods: {
    catView() {
      this.$router.push({ name: "adminCatalogue" });
    },
    catAdd() {
      this.$router.push({ name: "adminProductAdd" });
    },
    companyView() {
      this.$router.push({ name: "adminCompanies" });
    },
    companyAdd() {
      this.$router.push({ name: "adminAddCompany" });
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
    memberAdd() {
      this.$router.push({ name: "companiesAddMembers" });
    },
    showMembers() {
      this.$router.push({ name: "companiesMembers" });
    },
    news() {
      this.$router.push({ name: "adminNews" });
    },
    newsAdd() {
      this.$router.push({ name: "adminNewsAdd" });
    },
  },
};
</script>

<style>
/* .vuecal__menu,
.vuecal__cell-events-count {
  background-color: #e78c15;
}
.vuecal__title-bar {
  background-color: #f3f5e4a8;
}
.vuecal__cell--today,
.vuecal__cell--current {
  background-color: rgba(240, 240, 255, 0.4);
}
.vuecal:not(.vuecal--day-view) .vuecal__cell--selected {
  background-color: rgba(235, 255, 245, 0.4);
}
.vuecal__cell--selected:before {
  border-color: #e78c15;
} */
</style>
