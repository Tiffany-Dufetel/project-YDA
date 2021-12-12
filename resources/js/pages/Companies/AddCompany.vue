<!--
-- Add company page component
-->

<template>
  <div>
    <Header
      title="Ajouter une entreprise"
      subtitle="Tapez le SIRET afin de pré remplir"
    />
    <BackButton />
    <form @submit.prevent="addCompany">
      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "addCompany",
  components: {
    Header,
    BackButton,
    SubmitButton,
  },
  methods: {
    addCompany() {},
  },
};
</script>

<style>
</style>