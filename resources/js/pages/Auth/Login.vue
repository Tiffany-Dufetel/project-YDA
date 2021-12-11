<template>
  <div class="container">
    <Header title="Connexion" />
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-danger" role="alert" v-if="error !== null">
          {{ error }}
        </div>

        <div class="card card-default">
          <div class="card-header">Login</div>
          <div class="card-body">
            <form>
              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right"
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

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <!-- type="submit"
                    class="btn btn-primary"
                    @click="handleSubmit" -->
                  <router-link to="/admin"><button>Log in</button></router-link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "Login",
  components: {
    Header,
  },
  data() {
    return {
      email: "",
      password: "",
      error: null,
    };
  },
};
</script>