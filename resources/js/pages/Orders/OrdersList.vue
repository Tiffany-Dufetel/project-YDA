<!--
-- Order list display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="name of member or order" subtitle="Commandes" />
    <BackButton />
    <AddButton name="Commandez" @click="add" />
    <br />

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date Ordered</th>
          <th>Date delivered</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orderArray" :key="order.id">
          <td>{{ product.name }}</td>
          <td>{{ order.date_delivery }}</td>
          <td>{{ order.date_delivery }}</td>
          <td>{{ order.status }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualorder', params: { id: order.id } }"
                class="btn btn-primary"
                >Edit
              </router-link>
              <button class="btn btn-danger" @click="deleteorder(order.id)">
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
    };
  },
  async mounted() {
    const getCompanies = await axios.get("/api/order");
    this.orderArray = getCompanies.data.data;
    console.log(this.orderArray);
  },
  methods: {
    add() {
      this.$router.push({ name: "adminAddorder" });
    },
    deleteorder(id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .delete(`/api/order/delete/${id}`)
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
};
</script>