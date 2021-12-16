<template>
  <div class="container">
    <Header title="Connexion" />
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- <div class="alert alert-danger" role="alert" v-if="error !== null">
          {{ error }}
        </div> -->

        <div class="card card-default mt-5">
          <div class="card-header">Login</div>
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <form @submit.prevent="login">
                <div class="form-group row">
                  <label
                    for="email"
                    class="col-sm-4 col-form-label text-md-right"
                    >E-Mail Address</label
                  >
                  <div class="col-md-6">
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      v-model="email"
                      required
                      autofocus
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="form-group row">
                  <label
                    for="password"
                    class="col-md-4 col-form-label text-md-right"
                    >Password</label
                  >
                  <div class="col-md-6">
                    <input
                      id="password"
                      type="password"
                      class="form-control"
                      v-model="password"
                      required
                      autocomplete="off"
                    />
                  </div>
                </div>

                <div class="form-group row mb-0 mt-2">
                  <SubmitButton name="Submit" />
                </div>
              </form>
              <!-- Password Reset Request -->
              <div>
                <button @click="password">Mot de passe oublié</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "ResetPassword",
  components: {
    Header,
    SubmitButton,
  },
  data() {
    return {
      formData: {
        email: "",
        password: "",
        error: null,
      },
    };
  },
  /*  methods: {
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/reset", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            console.log("reponse: ", response);
            this.$router.push("/login");
          });
        //   .catch(function (error) {
        //     console.error(error);
        //   });
      });
    },
  }, */
};
</script>
