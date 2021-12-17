<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header v-model:title="company.name" subtitle="" />
  </div>
  <div>
    <div>
      <p>Siret : {{ company.siret }}</p>

      <p>
        Adresse : {{ company.adress }} - {{ company.postcode }}
        {{ company.city }}
      </p>

      <button @click="isHidden = !isHidden">
        {{ isHidden ? "Ajouter un membre" : "Masquer le formulaire" }}
      </button>

      <!--  Add members -->
      <AddMember v-if="!isHidden" title="Ajouter un membre" subtitle="" />

      <!-- Orders display -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom de la commande</th>
            <th>Utilisateur</th>

            <th>Statut de la commande</th>
            <th>Date de réservation de la commande</th>
            <th>Date estimée</th>
            <th>Commentaire</th>
            <th>PDF</th>
          </tr>
        </thead>
        <tbody>
          <CatalogueDisplay
            v-for="(order, index) in orders"
            :key="index"
            :id="order.id"
            :name="order.product.name"
            :user_surname="order.user.surname"
            :user_firstname="order.user.first_name"
            :status="order.status"
            :date_order="order.date_order"
            :date_delivery="order.date_delivery"
            :comment="order.comment"
            :pdf="order.pdf"
          />
        </tbody>
      </table>

      <!-- Member list display -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <MembersList
            v-for="(user, index) in filterUsers"
            :key="index"
            :id="user.id"
            :first_name="user.first_name"
            :surname="user.surname"
            :birthday="user.birthday"
            :email="user.email"
          />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import AddMember from "../../components/ui/forms/AddMember.vue";
import MembersList from "../../components/Members/MembersList.vue";
import CatalogueDisplay from "../../components/ui/catalogue/CatalogueDisplay.vue";

export default {
  name: "CompanyDisplay",
  components: {
    Header,
    AddMember,
    MembersList: MembersList,
    CatalogueDisplay,
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  data() {
    return {
      isHidden: true,
      company: {},
      user: {},
      companyId: "",
      filterUsers: [],
      orders: [],
    };
  },

  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);

    // Loading of users' information
    const userResponse = await axios.get("/api/user");
    const users = userResponse.data;

    const orderResponse = await axios.get("/api/order");
    this.orders = orderResponse.data;
    console.log("order", this.orders);

    const getUser = await axios.get("/api/login");
    this.companyId = getUser.data.company_id;

    this.filterUsers = users.filter((user) => user.company_id == this.id);

    this.role = getUser.data.role;
    console.log("user", users);

    this.company = response.data;
  },
};
</script>

<style>
</style>
