<template>
<div>
    <Header title="Modifier la commande" subtitle="" />
    <BackButton />

    <div class="alert alert-success" v-show="success">
      Votre item a bien été mis à jour
    </div>

    <div class="container">
        <form class="formContent" action="POST" @submit.prevent>
            <label for="date_delivery" >Date de livraison</label>
            <input class="inputText marginBot" type="text" name="date_delivery" id="date_delivery" v-model="orderUpdate.date_delivery">
            <label for="products_id">Produits</label>
            <input class="inputText marginBot" type="text" name="products_id" id="products_id" v-model="orderUpdate.products_id">
            <label for="status">Statut</label>
                <select class="inputText marginBot" name="status" v-model="orderUpdate.status">
                <option></option>
                <option>en attente</option>
                <option>en cours</option>
                <option>terminé</option>
                </select>
                <SubmitButton @click="statusUpdate" name="Modifier" />
        </form>
    </div>
</div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";

export default {
        name: "OrderUpdate",
        components: {
        Header,
        SubmitButton,
        BackButton,
        },

      data(){
          return{
              orderUpdate: {}
          }
      },

    methods: {
        statusUpdate(){
        axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .put("/api/order/" + this.$route.params.id, this.orderUpdate,{
          })
          .then((res) => {
            this.success = true;
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
      });        }
    },

      async mounted(){
        const response = await axios.get("/api/order/" + this.$route.params.id);
        this.orderUpdate = response.data;
        console.log('frgreg',this.orderUpdate)
      }
}
</script>
