<!--
-- First Connection Page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre compte YDA"
      subtitle="Veuillez réinitialer votre mot de passe"
    />

    <div class="alert alert-success" role="alert">
      A fresh verification link has been sent to your email address.
    </div>

    Before proceeding, please check your email for a verification link. If you
    did not receive the email,
    <!--  action="{{ route('verification.resend') }}" -->
    <form @submit.prevent="resend" method="POST" class="d-inline">
      <button type="submit" class="d-inline btn btn-link p-0">
        click here to request another</button
      >.
    </form>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "FirstConnection",
  components: {
    Header,
  },
  methods: {
    resend() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios.post("/email/resend").then((response) => {
          console.log("reponse: ", response);
        });
      });
      /* this.$router.push("/admin"); */
    },
  },
};
</script>

<style>
</style>