<!--
-- Admin home page component
-->

<template>
  <div class="d-flex justify-content-center flex-wrap mt-3">
    <!-- Catalogue card -->
    <div class="card-container" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Catalogue</h5>
        <p class="card-text">Vos produits et services.</p>
        <div class="buttons">
          <button @click="catView" class="card-link">Voir</button>
          <button @click="catAdd" class="card-link">Ajouter</button>
        </div>
      </div>
    </div>

    <!-- Companies card -->
    <div class="card-container" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Entreprises</h5>
        <p class="card-text">
          Tous les entreprises actuellement actives sur YDA.
        </p>
        <div class="buttons">
          <button @click="companyView" class="card-link">Voir</button>
          <button @click="companyAdd" class="card-link">Ajouter</button>
        </div>
      </div>
    </div>

    <!-- Orders card -->
    <div class="card-container" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Commandes</h5>
        <p class="card-text">Les commandes en cours, en attente et terminés.</p>
        <div class="buttons">
          <button @click="orderList" class="card-link">Voir</button>
        </div>
      </div>
    </div>

    <!-- News card -->
    <div class="card-container" style="width: 18rem">
      <div class="card-body">
        <h5 class="card-title">Actualités</h5>
        <p class="card-text">
          Les actualités que vous avez ajoutés pour les entreprises.
        </p>
        <div class="buttons">
          <button @click="news" class="card-link">Voir</button>
          <button @click="newsAdd" class="card-link">Ajouter</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Pie chart-->
  <!-- <pie-chart :data="chartData" :options="chartOptions"></pie-chart> -->

  <!-- Calendar displaying upcoming events -->
  <CalendarTwo />
</template>

<script>
import axios from "axios";
import CalendarTwo from "../../components/ui/admin/CalendarTwo.vue";
/* import PieChart from "../../components/ui/PieChart.vue"; */
/* import Chart from "chart.js/auto"; */
export default {
  name: "AdminHome",
  components: {
    CalendarTwo,
    /* PieChart, */
  },

  data() {
    return {
      productArray: [],
      role: "",
      id: "",
      chartOptions: {
        hoverBorderWidth: 20,
      },
      chartData: {
        hoverBackgroundColor: "red",
        hoverBorderWidth: 10,
        labels: ["Green", "Red", "Blue"],
        datasets: [
          {
            label: "Data One",
            backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
            data: [1, 10, 5],
          },
        ],
      },
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
      this.$router.push({ name: "adminNewsAdd", params: { id: this.id } });
    },
  },
};
</script>

<style>
.card-container {
  border: none;
  -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
  box-shadow: 1px 1px 15px 1px #dddddd;
  margin: 10px;
  padding: 10px;
  border-radius: 15px;
  background-color: white;
  height: 190px;
}

.card-title {
  color: #e78c15;
  border-bottom: 1px solid #e78c15;
  padding: 0 10px 10px 10px;
}

.buttons {
  text-align: center;
}

.buttons button {
  border: 1px solid #e78c15;
  border-radius: 5px;
  background-color: white;
  color: #e78c15;
}
</style>
