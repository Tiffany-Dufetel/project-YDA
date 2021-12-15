<!--
-- Add members page component
-->

<template>
  <div>
    <Header
      title="Ajouter un membre"
      subtitle="Ajouter soit un membre, soit plusieurs"
    />
    <form method="POST" @submit.prevent="addUser">
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
      <input type="text" id="password" name="password" v-model="password" />
      <br />

      <label for="birthday">Date d'anniversaire</label><br />
      <input type="date" id="birthday" name="birthday" v-model="birthday" />
      <br />

      <!-- Admin can add the role of the new member -->
      <!-- <div v-if="role == 'admin'"> -->
      <label for="role">Role</label><br />
      <select id="role" name="role" v-model="role">
        <option value="manager">Gestionnaire</option>
        <option value="member">Membre</option>
      </select>
      <br />
      <!-- </div> -->

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
  name: "companiesAddMembers",

  data() {
    return {
      surname: "",
      first_name: "",
      email: "",
      password: "",
      birthday: "",
      role: "",
      company_id: "1",
      data: {},
    };
  },

  async mounted() {
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("user", this.role);
  },

  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  methods: {
    addUser() {
      /* $company_id = this.$id;
      console.log($company_id); */
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user", {
            surname: this.surname,
            first_name: this.first_name,
            email: this.email,
            password: this.password,
            role: this.role,
            birthday: this.birthday,
            company_id: "1",
          })
          .then((response) => {
            console.log(response);
            this.$router.push({
              name: "adminHome",
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
