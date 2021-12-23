<!--
-- Order list display page component
HIDE COMMANDEZ SI NON MEMBER
SHOW ORDERS FOR ONE ID OR ONE MEMBER IF THAT ROLE
-->

<template>
  <div class="catalogue_container">
    <!-- rendre le nom reactive -->
    <Header
      title="Vos commandes"
      subtitle="Gérer vos commandes en attente, en cours et terminé"
    />
    <BackButton />

    <input
      id="input-search"
      v-model="searchKeyOrder"
      class="form-control mr-sm-2"
      type="text"
      placeholder="Rechercher...."
      aria-label="Search"
      autocomplete="off"
    />
    <br />
    <div v-if="role === 'membre'">
      <AddButton name="Commandez" @click="add" />
      <br />
    </div>

    <table class="center-table">
      <thead>
        <tr>
          <th>Entreprise</th>
          <th>Client</th>
          <th>Commande</th>
          <th>Commentaire</th>
          <th>Date de commande</th>
          <th>Date de livraison</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in filteredListOrder" :key="order.id">
          <td  valign="middle">
            <b>{{ order.user.company.name }}</b>
          </td>
          <td valign="middle">
            <span class="capitalize_firstname">{{
              order.user.first_name
            }}</span>
            {{ order.user.surname.toUpperCase() }}
          </td>
          <td valign="middle">{{ order.product.name }}</td>
          <td valign="middle">{{ order.comment }}</td>
          <td valign="middle">{{ order.date_order }}</td>
          <td valign="middle">{{ order.date_delivery }}</td>
          <td valign="middle">
              {{order.status}}
          </td>
          <td valign="middle">
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualorder', params: { id: order.id } }"
                ><button class="btn-show">Modifier</button>
              </router-link>
              <!-- v-if="status" -->
              <button class="btn-delete" @click="deleteOrder(order.id)">
                <ion-icon name="trash"></ion-icon>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import AddButton from "../../components/ui/buttons/AddButton.vue";
import OrderUpdate from "./OrderUpdate.vue"

export default {
  name: "orderList",
  components: {
    Header,
    BackButton,
    AddButton,
    OrderUpdate,
  },

  inject: ["checkRole", "whatRole"],
  data() {
    return {
      orderArray: [],
      searchKeyOrder: "",
      order: null,
      orderStatus:{},
    };
  },
  async mounted() {
    this.retrieveOrders();
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("roleadmin", this.role);
    this.id = getUser.data.id;

    const response = await axios.get(`/api/order/`);
    this.productInfo = response.data;

  },

  computed: {
    /** Search box */
    filteredListOrder() {
      return this.orderArray.filter((order) => {
        return (
          order.user.company.name
            .toLowerCase()
            .includes(this.searchKeyOrder.toLowerCase()) ||
          order.user.surname
            .toLowerCase()
            .includes(this.searchKeyOrder.toLowerCase()) ||
          order.status.toLowerCase().includes(this.searchKeyOrder.toLowerCase())
        );
      });
    },
  },
  methods: {

      statusUpdate(){

      },
    /** Retrieve full list of orders from database */
    async retrieveOrders() {
      const response = await axios.get("/api/order");
      this.orderArray = response.data;
      console.log("reponse", this.orderArray);
    },
    /** Refresh the list when changes are made */
    async refreshList() {
      this.retrieveOrders();
      this.order = null;
    },
    /** Go to "add order" page */
    add() {
      this.$router.push({ name: "productOrder" });
    },
    /** Delete a specific order */
    deleteOrder(id) {
      if (
        confirm(
          "Etes-vous sur d'effacer cette commande ? Vous pouvez également changé son status"
        )
      ) {
        axios
          .delete(`api/order/${id}`)
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

<style scoped>
.capitalize_firstname {
  text-transform: capitalize;
}
</style>
