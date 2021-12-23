<template>
  <div class="container flex-column">
    <Header class="headerModPass" title="Modifier votre Mot de Passe" />

        <div class="container marginBotXL">
            <div class ="alert alert-success" v-show="success">Le membre a bien été ajouté</div>
            <form class="formContent" method="POST" @submit.prevent="addUser">

                <label for="password">Nouveau mot de passe</label>
                <input type="text" id="password" class="inputText marginBot" name="password" v-model="password" />


                <SubmitButton name="Ajouter" />
                <!-- Password Reset Request -->
            </form>
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
        password: "",
        error: null,
    };
  },
 methods: {
    resetPassword() {
        axios.get("/sanctum/csrf-cookie").then((response) => {
         axios
          .post("http://127.0.0.1:8000/api/user/edit-firstPassword/" + this.$route.params.id,{
            password: this.password,
            token: this.$route.params.hash
          })
          .then((res) => {

            this.success = true,
            this.$router.push("/")
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
        });
      this.success = true;
      console.log('id', this.$route.params.id);
      console.log('token', this.$route.params.hash);

    },

  },
};
</script>

<style scoped>
.headerModPass{
    margin-bottom: 40px;
}
</style>
