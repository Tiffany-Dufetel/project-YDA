<template>
  <div class="containerLogin">
    <Header title="Connexion" />

    <!-- <div class="alert alert-danger" role="alert" v-if="error !== null">
          {{ error }}
        </div> -->
    <form class="formContent" @submit.prevent="login">
      <div>
        <label for="email">Adresse E-Mail</label>

        <input
          id="email"
          type="email"
          v-model="email"
          class="inputText marginBot"
          required
          autofocus
          autocomplete="off"
        />
      </div>

      <div>
        <label for="password">Mot de Passe</label>
        <input
          id="password"
          type="password"
          class="inputText marginBot"
          v-model="password"
          required
          autocomplete="off"
        />
      </div>

      <SubmitButton name="Submit" />
      <div>
        <button
          @click="password"
          class="text-danger border-0 bg-transparent fs-6"
        >
          Mot de passe oublié
        </button>
      </div>
    </form>
    <!-- Password Reset Request -->
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "Login",
  components: {
    Header,
    SubmitButton,
  },
  inject: ["setLoginStatus"],
  data() {
    return {
      token: "",
      formData: {
        email: "",
        password: "",
        error: null,
      },
    };
  },
  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            console.log("reponse: ", response);
            localStorage.setItem("userToken", response.data.data.token);
            this.setLoginStatus();
            this.$router.push("/yda");
          });
        //   .catch(function (error) {
        //     console.error(error);
        //   });
      });
    },
    password() {
      this.$router.push({ name: "ResetPassword" });
    },
  },
};
</script>

<style scoped>
.containerLogin {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
}

.formContent {
  margin-top: 30px;
}
</style>
