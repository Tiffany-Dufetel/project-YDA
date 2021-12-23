<!--
-- Company individual display page component
REFRESH ON MEMBER ADD / DELETE
-->

<template>
  <div class="catologue_container">
    <!-- Loading of reactive data thanks to the mounted axios-->
    <Header v-model:title="company.name" subtitle="" />
    <BackButton />
  </div>

  <div class="container">

    <div class="info-company-container">
        <div class="info-company">
            <p>
                <b><u>Siret :</u></b> {{ company.siret }}<br>
                <b><u>Adresse :</u></b> {{ company.adress }} - {{ company.postcode }} {{ company.city }}<br>
                <b><u>Numéro de téléphone :</u></b> {{ company.number }}
            </p>

            <button class="btn-show" @click="goToUpdate">Modifier</button>
        </div>
        <div class="map">
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

    <div class="buttons-show-info">
      <button @click="isHidden = !isHidden">
        {{ isHidden ? "Ajouter un membre" : "Masquer le formulaire" }}
      </button>

    <button @click="newsAdd">Ajouter une actualité</button>

    </div>

      <!--  Add members -->
      <AddMember v-if="!isHidden" title="Ajouter un membre" subtitle="" />

      <!-- Orders display -->
    <table class="center-table">
        <thead>
          <tr>
            <th>Nom de la commande</th>
            <th>Utilisateur</th>

            <th>Statut</th>
            <th>Date de commande</th>
            <th>Date estimée</th>
            <th>Commentaire</th>
            <!-- <th>PDF</th> -->
            <th></th>
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
            :company_id="order.id"
          />
        </tbody>

      </table>
      <!-- Member list display -->
      <table class="center-table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Email</th>
            <th>Rôle</th>
            <th></th>
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
    <h1><u>Les actualités récentes:</u></h1>
    <br/>
    <div v-for="news in newsArray" :key="news.id">
      <h3>
        <strong> {{ news.title }} </strong>
      </h3>
      <p>{{ news.text }}</p>
      <i> {{ new Date(news.created_at).toLocaleString() }} </i>
      <br />
      <br />

      <h1><u>Les actualités récentes:</u></h1>
      <br />
      <div v-for="news in newsArray" :key="news.id">
        <h3>
          <strong> {{ news.title }} </strong>
        </h3>
        <p>{{ news.text }}</p>
        <i> {{ new Date(news.created_at).toLocaleString() }} </i>
        <br />
        <button class="btn-delete" @click="deleteActuality(news.id)">
          <ion-icon name="trash"></ion-icon>
        </button>
      </div>
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
      role: "",
    };
  },
  async mounted() {
    //We are loading the company display thanks to the ID;
    const response = await axios.get("/api/company/" + this.id);
    console.log("response", response.data);

    // Loading of users' information
    const userResponse = await axios.get("/api/user");
    const users = userResponse.data;

    // all order
    const orderResponse = await axios.get("/api/order");
    this.orders = orderResponse.data;
    const orders = this.orders;
    console.log("order", this.orders);

    // get company ID
    const getUser = await axios.get("/api/login");
    this.companyId = getUser.data.company_id;
    this.role = getUser.data.role;
    console.log("user", users);
    // filter the users according to company ID
    this.filterUsers = users.filter((user) => user.company_id == this.id);
    this.filterOrders = orders.filter(
      (order) => order.user.company_id == this.id
    );

    console.log('ihorhgiorhgorz', this.filterOrders)

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
    toggleModale() {
      this.revele = !this.revele;
    },
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
.info-company-container{
    display: flex;
    justify-content: center;
    border: none;
    -webkit-box-shadow: 1px 1px 15px 1px #dddddd;
    box-shadow: 1px 1px 15px 1px #dddddd;
    margin: 10px;
    padding: 10px;
    border-radius: 15px;
    background-color: white;
    height: 347px;
}

.info-company{
    flex-direction: column;
    height: 328px;
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map{
    padding: 30px;
}

.buttons-show-info{
    text-align: center;
}

.buttons-show-info button{
    background-color: white;
    padding: 8px 20px 5px 20px;
    border-radius: 5px;
    border: 2px solid #e78c15;
    position: relative;
    margin: 20px;
    top: 30;

    color: #e78c15;
}
</style>
