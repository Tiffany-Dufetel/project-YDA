<!--
-- Add members page component
-->

<template>
  <div>
    <Header
      title="Ajouter un membre"
      subtitle="Ajouter soit un membres, soit plusieurs"
    />
    <BackButton />
    <form @submit.prevent="addMembers">
      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "AddMembers",
  components: {
    Header,
    SubmitButton,
    BackButton,
  },
};
</script>

<style>
</style>
