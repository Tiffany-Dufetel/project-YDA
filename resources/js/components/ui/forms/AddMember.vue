 <!--
-- Add member Display form UI component
-->

<template>
  <div class="container marginBotXL">
    <form class="formContent" method="POST" @submit.prevent="addUser">
            <div class ="alert alert-success" v-show="success">Le membre a bien été ajouté</div>

      <div><label for="surname">Nom</label>
      <input type="text" class="inputText marginBot" id="surname" name="surname" v-model="surname" /></div>
        <div v-show="errors && errors.surname">
            <p class="text-danger" v-for="(error, index) in errors.surname" :key="index" >{{error}}</p>
        </div>

      <div><label for="first_name">Prénom</label>
      <input
        type="text"
        id="first_name"
        name="first_name"
        class="inputText marginBot"
        v-model="first_name"
      /></div>
        <div v-show="errors && errors.first_name">
            <p class="text-danger" v-for="(error, index) in errors.first_name" :key="index" >{{error}}</p>
        </div>

      <div><label for="email">Email</label>
      <input type="text" id="email" name="email" class="inputText marginBot" v-model="email" /></div>
        <div v-show="errors && errors.email">
            <p class="text-danger" v-for="(error, index) in errors.email" :key="index" >{{error}}</p>
        </div>

      <div><label for="password">Mot de passe</label>
      <input type="text" id="password" class="inputText marginBot" name="password" v-model="password" /></div>
        <div v-show="errors && errors.password">
            <p class="text-danger" v-for="(error, index) in errors.password" :key="index" >{{error}}</p>
        </div>

      <div><label for="birthday">Date d'anniversaire</label>
      <input type="date" id="birthday" class="inputText marginBot" name="birthday" v-model="birthday" /></div>
        <div v-show="errors && errors.birthday">
            <p class="text-danger" v-for="(error, index) in errors.birthday" :key="index" >{{error}}</p>
        </div>

      <!-- Admin can add the role of the new member -->
      <!-- <div v-if="role == 'admin'"> -->
      <div><label for="role">Role</label>
      <select class="inputText marginBot" id="role" name="role" v-model="role">
        <option value="manager">Gestionnaire</option>
        <option value="member">Membre</option>
      </select></div>
        <div v-show="errors && errors.role">
            <p class="text-danger" v-for="(error, index) in errors.role" :key="index" >{{error}}</p>
        </div>

      <input type="hidden" name="company_id" :value="id" />

      <!-- </div> -->

      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import SubmitButton from "../buttons/SubmitButton.vue";

export default {
    name: "companiesAddMembers",
    props: {
        id: Number,
    },
  data() {
    return {
      surname: "",
      first_name: "",
      email: "",
      password: "",
      birthday: "",
      role: "",
      company_id: "",
      data: {},
      success: false,
      errors: {},
    };
  },

  /* async mounted() {
    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
    console.log("user", this.role);
  }, */

  components: {
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
            company_id: this.id,
          })
          .then((response) => {
            this.surname = "",
            this.first_name = "",
            this.email = "",
            this.password = "",
            this.birthday = "",
            this.role = "",
            this.company_id = "",
            this.success = true
          }).catch(error=>{
            if (error.response.status == 422 ){
                this.errors = error.response.data.errors
            }
            })
      });
    },
  },
};
</script>

<style>
.marginBotXL{
    margin-bottom: 30px;
}
</style>
