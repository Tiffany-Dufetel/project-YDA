<!--
-- View company update page component
BACK BUTTON
-->

<template>
  <div>
    <!-- <div class ="alert alert-success" v-show="success">Le membre a bien été mis à jour</div> -->
    <BackButton />

    <form @submit.prevent="updateMember">
      <label for="surname">Nom</label><br />
      <input type="text" id="surname" name="surname" v-model="surname" /><br />
      <div v-show="errors && errors.surname">
        <p
          class="text-danger"
          v-for="(error, index) in errors.surname"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="first_name">Prénom</label><br />
      <input
        type="text"
        id="first_name"
        name="first_name"
        v-model="first_name"
      /><br />
      <div v-show="errors && errors.first_name">
        <p
          class="text-danger"
          v-for="(error, index) in errors.first_name"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="email">Email</label><br />
      <input type="text" id="email" name="email" v-model="email" /><br />
      <div v-show="errors && errors.email">
        <p
          class="text-danger"
          v-for="(error, index) in errors.email"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
      <label for="password">Mot de passe</label><br />
      <input
        type="text"
        id="password"
        name="password"
        v-model="password"
      /><br />
      <div v-show="errors && errors.password">
        <p
          class="text-danger"
          v-for="(error, index) in errors.password"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
      <br />

      <label for="birthday">Date d'anniversaire</label><br />
      <input
        type="date"
        id="birthday"
        name="birthday"
        v-model="birthday"
      /><br />
      <div v-show="errors && errors.birthday">
        <p
          class="text-danger"
          v-for="(error, index) in errors.birthday"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <!-- Admin can add the role of the new member -->
      <!-- <div v-if="role == 'admin'"> -->
      <label for="role">Role</label><br />
      <select id="role" name="role" v-model="role">
        <option value="manager">Gestionnaire</option>
        <option value="member">Membre</option>
      </select>
      <div v-show="errors && errors.role">
        <p
          class="text-danger"
          v-for="(error, index) in errors.role"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <input type="hidden" name="company_id" :value="id" />

      <!-- </div> -->

      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "MemberUpdate",
  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  data() {
    return {
      memberInfo: {},
      surname: "",
      first_name: "",
      email: "",
      password: "",
      birthday: "",
      role: "",
      success: false,
      errors: {},
    };
  },

  methods: {
    updateMember() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user/" + this.$route.params.id, {
            surname: this.surname,
            first_name: this.first_name,
            email: this.email,
            password: this.password,
            birthday: this.birthday,
            role: this.role,

            _method: "put",
          })
          .then((res) => {
            (this.surname = ""),
              (this.first_name = ""),
              (this.email = ""),
              (this.password = ""),
              (this.birthday = ""),
              (this.role = ""),
              (this.success = true);
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
      });
      this.success = true;
    },
  },

  //     async mounted(){
  // const response = await axios.get("/api/company/" + this.$route.params.id);
  // this.companyInfo =  response.data
  // console.log('abc', this.companyInfo)

  // }
};
</script>

<style>
</style>
