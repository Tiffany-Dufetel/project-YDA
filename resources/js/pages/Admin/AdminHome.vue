<!--
-- Admin home page component
-->

<template>
  <div>
    <Header
      title="Bienvenue à votre page administration"
      subtitle="Gérer vos entreprises et catalogue ici"
    />
    <router-link to="admin/catalogue"
      ><button>Voir Catalogue</button></router-link
    >
    <router-link to="admin/catalogue/add"
      ><button>Ajouter dans le catalogue</button></router-link
    >
    <router-link to="admin/entreprises"
      ><button>Voir entreprises</button></router-link
    >
    <router-link to="admin/entreprises/add"
      ><button>Ajouter une entreprise</button></router-link
    >
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
export default {
  name: "AdminHome",
  components: {
    Header,
  },
};
</script>

<style>
</style>