<!--
-- Add members page component
-->

<template>
  <div>
    <Header
      title="Ajouter un membre"
      subtitle="Ajouter soit un membress, soit plusieurs"
    />
    <form @submit.prevent="addMembers">
      <SubmitButton name="Ajouter" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";

export default {
  name: "AddMembers",
  components: {
    Header,
    SubmitButton,
  },
};
</script>

<style>
</style>
