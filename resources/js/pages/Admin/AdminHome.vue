<!--
-- Admin home page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre page administration"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <div class="mt-5">
      <button @click="catView">Voir Catalogue</button>
      <button @click="catAdd">Ajouter dans le catalogue</button>
      <button @click="companyView">Voir entreprises</button>
      <button @click="companiesAddMembers">Ajouter une membre</button>

      <button @click="companyAdd">Ajouter une entreprise</button>
    </div>

    <button @click="order">Commander</button>

    <!-- Calendar displaying upcoming events -->
    <div class="d-flex justify-content-center mt-5 mb-1">
      <vue-cal
        :time-from="9 * 60"
        :time-to="19 * 60"
        :time-step="60"
        hide-weekends
        style="height: 350px; width: 80%"
      />
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import axios from "axios";
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";

export default {
  name: "AdminHome",
  components: {
    Header,
    VueCal,
  },

  data() {
    return {
      productArray: [],
    };
  },
  async mounted() {
    const getProduct = await axios.get("/api/product");

    // this.productArray = getProduct.data.data;

    console.log(getProduct);
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
    memberAdd() {
      this.$router.push({ name: "companiesAddMembers" });
    },
  },
};
</script>

<style>
.vuecal__menu,
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
}
</style>
