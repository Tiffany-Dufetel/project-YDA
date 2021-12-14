<!--
-- Add members page component
-->

<template>
  <div>
    <Header
      title="Ajouter un membre"
      subtitle="Ajouter soit un membres, soit plusieurs"
    />
    <form @submit.prevent="addUsers">

        <label for="surname">Nom</label><br>
        <input type="text" id="surname" name="surname" v-model="surname"><br>

        <label for="first_name">Prénom</label><br>
        <input type="text" id="first_name" name="first_name" v-model="first_name"><br>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" v-model="email"><br>

        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password" v-model="password"><br>

        <label for="role">Rôle</label><br>
        <select name="role" id="role" v-model="role">
        <option value="Membre">Membre</option>
        <option value="Gestionnaire">Gestionnaire</option>
        </select>

        <label for="birthday">Date d'anniversaire</label><br>
        <input type="date" id="birthday" name="birthday" v-model="birthday">

        <label for="comment">Commmentaire</label><br>
        <input type="textarea" id="comment" name="comment" v-model="comment"><br>


      <SubmitButton name="Ajouter" @click="addUsers"/>
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import axios from 'axios';

export default {
  name: "addUsers",

 data(){
      return {
          Surname: "",
          first_name:"",
          email:"",
          password:"",
          role:"",
          birthday:"",
          commentaire:"",
          data:{},

      }


  },


  components: {
    Header,
    BackButton,
    SubmitButton,
  },


methods:{

addUsers(){
      axios.get("/sanctum/csrf-cookie")
      .then((response) => {
        axios
          .post("/api/users/store", {
            surname:this.surname,
            first_name:this.first_name,
            email:this.email,
            password:this.password,
            role:this.role,
            birthday:this.birthday,
            comment:this.comment,


          })
          .then((response) => {
            console.log(response)
            this.$router.push({ name: "users" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },

}

};



</script>

<style>
</style>
