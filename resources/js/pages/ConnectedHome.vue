<!--
-- Admin home page component
-->

<template>
  <div v-if="role == 'admin'">
    <Header
      v-model:title="firstname"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <AdminHome />
  </div>

  <div v-else-if="role == 'manager'">
    <Header
      v-model:title="firstname"
      message="bienvenue"
      accueil="sur votre page d'accueil"
      subtitle="Gérer les membres de votre entreprise"
    />
    <CompanyHome />
  </div>

  <div v-else-if="role == 'member'">
    <Header v-model:title="firstname" subtitle="Passez vos commandes" />
    <MembersDisplay />
  </div>

  <div v-else></div>
</template>

<script>
import Header from "../components/ui/Header.vue";
import axios from "axios";
import CalendarTwo from "../components/ui/admin/CalendarTwo.vue";
import MembersDisplay from "../pages/Members/MemberDisplay.vue";
import CompanyHome from "../pages/Companies/CompanyHome.vue";
import AdminHome from "../pages/Admin/AdminHome.vue";

export default {
  name: "ConnectedHome",
  components: {
    Header,
    CalendarTwo,
    MembersDisplay,
    AdminHome,
    CompanyHome,
  },

  data() {
    return {
      productArray: [],
      role: "",
      id: "",
      firstname: "",
    };
  },
  async mounted() {
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("role", this.role);
    this.firstname = getUser.data.first_name;
    console.log("blabla", this.firstname);
    this.id = getUser.data.id;
    // console.log("user", this.id);
  },

  /* methods: {
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
  }, */
};
</script>

<style>
</style>
