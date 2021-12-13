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
    <form method="POST" @submit.prevent="addCompany">


        <label for="siret">Siret</label><br>
        <input type="text" id="siret" name="siret" v-model="inputSiret" v-on:keypress.enter="siretSearch"><br>

        <label for="name">Dénomination social</label><br>
        <input type="text" id="name" name="name" v-model="name"><br>

        <label for="adress">Adresse</label><br>
        <input type="text" id="adress" name="adress" v-model="adress"><br>

        <label for="postCode">Code postal</label><br>
        <input type="text" id="postCode" name="postCode" v-model="postCode"><br>

        <label for="city">Ville</label><br>
        <input type="text" id="city" name="city" v-model="city"><br>

        <label for="employees">Nombre d'employés</label><br>
        <input type="number" id="employees" name="member_count"><br>


        <button type="submit">Ajouter</button>
      <!--<SubmitButton name="Ajouter" />-->
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import axios from 'axios';

export default {
  name: "addCompany",

  data(){
      return {
          inputSiret: "",
          name:"",
          adress:"",
          postCode:"",
          city:"",
          employees:"",
          data:{}
      }
  },

  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  methods: {

    async siretSearch(){
        const siret = this.inputSiret;
        const urlApi = `https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/${siret}`;
        const dataSiret = await fetch(urlApi);
        const responseDataSiret = await dataSiret.json();
        this.name=responseDataSiret.etablissement.denomination_usuelle;
        this.adress=responseDataSiret.etablissement.geo_l4;
        this.postCode=responseDataSiret.etablissement.code_postal;
        this.city=responseDataSiret.etablissement.libelle_commune;
    },

    addCompany() {
      axios.get("/sanctum/csrf-cookie")
      .then((response) => {
        axios
          .post("/api/company/store", {
            inputSiret:this.inputSiret,
            name:this.name,
            adress:this.adress,
            postCode:this.postCode,
            city:this.city,
            employees:this.employees,
          })
          .then((response) => {
            console.log(response)
            this.$router.push({ name: "company" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style>
</style>
