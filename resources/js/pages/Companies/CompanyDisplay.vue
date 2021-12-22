<!--
-- Company individual display page component
REFRESH ON MEMBER ADD / DELETE
-->

<template>
  <div>
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header v-model:title="company.name" subtitle="" />
  </div>
  <BackButton />
  <div>
    <div class="mt-5">
      <div class="row">
        <div class="col">
          <p>Siret : {{ company.siret }}</p>

          <p>
            Adresse : {{ company.adress }} - {{ company.postcode }}
            {{ company.city }}
          </p>

          <p>Numéro de téléphone : {{ company.number }}</p>
        </div>
        <div class="col">
          <iframe
            class="border border-warning shadow p-3 mb-5 bg-white rounded"
            width="600"
            height="250"
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
            v-bind:src="adressGPS"
          ></iframe
          ><br />
        </div>
      </div>
      </div>
</div>
      <button class="btn btn-warning" @click="goToUpdate">modifier</button>
      <button class="btn btn-dark" @click="isHidden = !isHidden">
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
          <OrderDisplay
            v-for="(order, index) in filterOrders"
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
            :role="user.role"
          />
        </tbody>
      </table>

<br />

<div>

<p>______</p>
    <button @click="newsAdd">Ajouter une actualité</button>
    <br />
    <p>______</p>
    <br />
    <br />


    <h1><u>Les actualités récentes:</u></h1>
    <br/>
    <div v-for="news in newsArray" :key="news.id">
      <h3>
        <strong> {{ news.title }} </strong>
      </h3>
      <p>{{ news.text }}</p>
      <i> {{ new Date(news.created_at).toLocaleString() }} </i>
      <br />
      <button class="btn btn-danger" @click="deleteActuality(news.id)">
        Effacer l'actualité
      </button>

  </div>
</div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import AddMember from "../../components/ui/forms/AddMember.vue";
import MembersList from "../../components/Members/MembersList.vue";
import OrderDisplay from "../../components/ui/orders/OrderDisplay.vue";
import axios from "axios";
export default {
  name: "CompanyDisplay",
name: "adminNews",
  components: {
    Header,
    AddMember,
    BackButton,
    MembersList,
    OrderDisplay,
    BackButton,
  },

  props: {
    id: {
      required: true,
      type: String,
    },
  },

  data() {
    return {
        company: {},
      newsArray: [],
      companies: [],
      isHidden: true,
      company: {},
      user: {},
      companyId: "",
      filterUsers: [],
      filterOrders: [],
      orders: [],
      adressGPS: "",

    };
  },
  async mounted() {



    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);
    console.log("response", response.data);

    // Loading of users' information
    const userResponse = await axios.get("/api/user");
    const users = userResponse.data;

    const orderResponse = await axios.get("/api/order");
    this.orders = orderResponse.data;
    const orders = this.orders;
    console.log("order", this.orders);

    const getUser = await axios.get("/api/login");
    this.companyId = getUser.data.company_id;

    this.filterUsers = users.filter((user) => user.company_id == this.id);
    this.filterOrders = orders.filter(
      (order) => order.user.company_id == this.id
    );

    this.role = getUser.data.role;
    console.log("user", users);

    this.company = response.data;
    const companyAdress = this.company.adress.toLowerCase().replace(/ /g, "+");
    const companyPostcode = this.company.postcode;
    const companyCity = this.company.city;
    this.adressGPS =
      "https://maps.google.com/maps?q=" +
      companyAdress.concat("+", companyPostcode, "+", companyCity) +
      "&output=embed";



    const getCompany = await axios.get("/api/company");
    this.companies = getCompany.data.data;


    this.retrieveActuality();
    console.log(this.companies);


  },


  methods: {
    goToUpdate() {
      this.$router.push("/entreprise/" + this.$route.params.id + "/modifier");
    },
    newsAdd() {
      this.$router.push({ name: "adminNewsAdd" });
    },
    async retrieveActuality() {
      const response = await axios.get("/api/company/" + this.id, {
        headers: {
          Authorization: "bearer " + localStorage.getItem("userToken"),
        },
      });
        console.log(this.companies);
      //console.log(response.data);
      this.company = response.data;

      const responseNews = await axios.get("/api/news/by-company/" + this.id);
      this.newsArray = responseNews.data;
      console.log(this.newsArray);
    },
    async refreshList() {
      this.retrieveActuality();
      this.actuality = null;
    },

    /** Delete a specific actuality */
    deleteActuality(actuality_id) {
      if (confirm("Etes-vous sur d'effacer cette actualité ?")) {
        axios
          .delete(`api/news/${actuality_id}`)
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
};
</script>

<style>
</style>
