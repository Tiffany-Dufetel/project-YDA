<!--
-- Order list display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header
      title="Vos commandes"
      subtitle="Gérer vos commandes en attente, en cours et terminé"
    />
    <BackButton />
    <AddButton name="Commandez" @click="add" />
    <br />

    <input
      v-model="searchKeyOrder"
      class="form-control mr-sm-2"
      type="search"
      placeholder="Rechercher...."
      aria-label="Search"
      autocomplete="off"
    />
    <br />

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Entreprise</th>
          <th>Client</th>
          <th>Commande</th>
          <th>Commentaire</th>
          <th>Date de commande</th>
          <th>Date de livraison</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in filteredListOrder" :key="order.id">
          <td><b>{{ order.user.company.name}}</b></td>
          <td><span class="capitalize_firstname">{{ order.user.first_name }}</span> {{order.user.surname.toUpperCase()}}</td>
          <td>{{ order.product.name}}</td>
          <td>{{ order.comment}}</td>
          <td>{{ order.date_order }}</td>
          <td>{{ order.date_delivery }}</td>
          <td>{{ order.status }}</td>
          <td>
            <div class="btn-group" role="group">
              <!-- <router-link
                :to="{ name: 'individualorder', params: { id: order.id } }"
                ><button class="btn btn-primary">Edit</button>
              </router-link> -->
              <button
                v-if="status"
                class="btn btn-danger"
                @click="deleteorder(order.id)"
              >
                Delete
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

export default {
  name: "orderList",
  components: {
    Header,
    BackButton,
    AddButton,
  },
  data() {
    return {
      orderArray: [],
      searchKeyOrder: "",

    };
  },
  async mounted() {
    const response = await axios.get("/api/order");
    this.orderArray = response.data;
    console.log("reponse",this.orderArray);
  },

   computed: {
    /** Search box */
    filteredListOrder() {
      return this.orderArray.filter((order) => {
        return(
          order.user.company.name.toLowerCase().includes(this.searchKeyOrder.toLowerCase()) ||
          order.user.surname.toLowerCase().includes(this.searchKeyOrder.toLowerCase()) ||
          order.status.toLowerCase().includes(this.searchKeyOrder.toLowerCase())
        );

      });
    },
   },
  methods: {
    add() {
      this.$router.push({ name: "productOrder" });
    },
    deleteorder(id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .delete(`/api/order/destroy/${id}`)
          .then((response) => {
            let i = this.order.map((item) => item.id).indexOf(id); // find index of your object
            this.order.splice(i, 1);
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
}

</script>

<style scoped>
.capitalize_firstname{
    text-transform: capitalize;
}
</style>
