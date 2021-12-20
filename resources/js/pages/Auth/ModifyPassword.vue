<template>
  <div class="container">
    <Header title="Modifier votre Mot de Passe" />
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- <div class="alert alert-danger" role="alert" v-if="error !== null">
          {{ error }}
        </div> -->

        <div class="card card-default mt-5">
          <div class="card-header">Login</div>
          <div class="card-body">
            <div class="d-flex justify-content-center">
              <form @submit.prevent="resetPassword">

                <div class="form-group row">
                  <label
                    for="password"
                    class="col-md-4 col-form-label text-md-right"
                    >Votre de mot de passe</label
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
  name: "ModifyPassword",
  components: {
    Header,
    SubmitButton,
  },
  data() {
    return {
      formData: {
        password: "",
        error: null,
      },
    };
  },
 methods: {
      resetPassword() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/user", {
            password: this.password,
          })
          .then((response) => {
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
