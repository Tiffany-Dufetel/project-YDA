<!--
-- Add members page component
-->

<template>
  <div>
    <Header
      title="Ajouter un membre"
      subtitle="Ajouter soit un membres, soit plusieurs"
    />
    <form action="" method="post"></form>
  </div>
</template>

<script>
import Header from "../components/ui/Header.vue";
export default {
  name: "addMember",
  components: {
    Header,
  },
};
</script>

<style>
</style>