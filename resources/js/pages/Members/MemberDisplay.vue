<!--
-- Member individual display page component
-->

<template>
    <div >
    <!-- rendre le nom reactive -->
    <div v-for="(info, index) in userInfo" :key="index">
    <Header :title=" info.company.name" /><br/>
    <BackButton />
        <AddButton name="Passer une commande" @click="add" /><br>

        <div class="d-flex justify-content-center">
            <div class="center col-md-5 user_info_container" >
                <h3> {{ info.surname.toUpperCase() }} {{ info.first_name }}</h3>

                <u>Nom:</u> {{ info.surname.toUpperCase() }}<br>
                <u>Email:</u> {{ info.email }}<br>
                <u>Prénom:</u> {{ info.first_name }}<br>
                <u>Date de naissance:</u> {{ info.birthday }}<br><br>

                <button class="log">editer profile</button>
            </div>
        </div>
    </div><br><br>

    <center><h1>Mes commandes</h1></center>
    <table id="table_margin" class="table table-bordered">
      <thead>
        <tr>
          <th>Commande</th>
          <th>Commentaire</th>
          <th>Date de commande</th>
          <th>Date de livraison</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orderArray" :key="order.id">
          <td>{{ order.product.name}}</td>
          <td>{{ order.comment}}</td>
          <td>{{ order.date_order }}</td>
          <td>{{ order.date_delivery }}</td>
          <td>{{ order.status }}</td>
          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-primary">Edit</button>
              <button class="btn btn-danger">
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
import AddButton from "../../components/ui/buttons/AddButton.vue"

export default {
  name: "MemberDisplay",
  components: {
    Header,
    BackButton,
    AddButton,
  },

  data(){
      return{
          userInfo: [],
          orderArray: [],
      }
  },

  async mounted(){
    const response = await axios.get("/api/user/" + this.$route.params.id);
    this.orderArray = response.data;
    console.log('order array', this.orderArray)

    const responseUser = await axios.get("/api/info/" + this.$route.params.id);
    this.userInfo = responseUser.data;
    console.log(this.userInfo)
  },

    methods: {
        add(){
            this.$router.push({ name: "productOrder" });
        }
    }
};
</script>

<style>
.user_info_container{
    border: 5px solid black;
    border-radius: 10px;
    padding: 20px;
}

.log {
  background-color: #e78c15;
  border-radius: 5px;
  padding: 5px 20px;
  border: 1px solid #e78c15;
  color: white;
}

.table_margin{
    margin-bottom: 500px !important;
}

</style>
