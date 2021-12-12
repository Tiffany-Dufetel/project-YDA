<!--
-- Add managers page component
-->

<template>
  <div>
    <!-- make title responsive -->
    <Header title="Name of company" subtitle="Ajouter vos managers" />
    <form @submit.prevent="addCompany">
      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
import SubmitButton from "../../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "addManagers",
  components: {
    Header,
    SubmitButton,
  },
};
</script>

<style>
</style>