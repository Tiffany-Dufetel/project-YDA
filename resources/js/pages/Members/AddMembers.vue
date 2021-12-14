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
      <label for="surname">Nom</label><br />
      <input type="text" id="surname" name="surname" v-model="surname" /><br />

      <label for="first_name">Prénom</label><br />
      <input
        type="text"
        id="first_name"
        name="first_name"
        v-model="first_name"
      /><br />

      <label for="email">Email</label><br />
      <input type="text" id="email" name="email" v-model="email" /><br />

      <label for="password">Mot de passe</label><br />
      <input
        type="text"
        id="password"
        name="password"
        v-model="password"
      /><br />

      <label for="birthday">Date d'anniversaire</label><br />
      <input type="date" id="birthday" name="birthday" v-model="birthday" />

      <label for="comment">Commmentaire</label><br />
      <input
        type="textarea"
        id="comment"
        name="comment"
        v-model="comment"
      /><br />

      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import axios from "axios";

export default {
  name: "addUsers",

  data() {
    return {
      surname: "",
      first_name: "",
      email: "",
      password: "",
      birthday: "",
      comment: "",
      data: {},
    };
  },

  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  methods: {
    addUser() {
      $company_id = this.$id;

      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user/store", {
            surname: this.surname,
            first_name: this.first_name,
            email: this.email,
            password: this.password,
            role: "member",
            birthday: this.birthday,
            comment: this.comment,
          })
          .then((response) => {
            console.log(response);
            this.$router.push({
              name: "individualCompany",
              params: { id },
            });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
</style>
