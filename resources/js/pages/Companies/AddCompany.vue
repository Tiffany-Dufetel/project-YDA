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
    <form method="POST" @submit.prevent>
      <label for="siret">Siret</label><br />
      <input
        type="text"
        id="siret"
        name="siret"
        v-model="siret"
        v-on:keypress.enter="siretSearch"
      /><br />

      <label for="name">Dénomination social</label><br />
      <input type="text" id="name" name="name" v-model="name" /><br />

      <label for="adress">Adresse</label><br />
      <input type="text" id="adress" name="adress" v-model="adress" /><br />

      <label for="postCode">Code postal</label><br />
      <input
        type="text"
        id="postCode"
        name="postCode"
        v-model="postcode"
      /><br />

      <label for="city">Ville</label><br />
      <input type="text" id="city" name="city" v-model="city" /><br />

      <label for="member_count">Nombre d'employés</label><br />
      <input
        type="number"
        id="member_count"
        name="member_count"
        v-model="member_count"
      /><br />

      <!-- Preferable day and time -->
      <label for="day">Jour et creneau horaire préféré</label>
      <div class="form-group row">
        <div class="col-xs-3">
          <select
            v-model="day"
            name="day"
            id="day"
            class="form-control"
            required="true"
          >
            <option selected>choisir le jour...</option>
            <option value="lundi">Lundi</option>
            <option value="mardi">Mardi</option>
            <option value="mercredi">Mercredi</option>
            <option value="jeudi">Jeudi</option>
            <option value="vendredi">Vendredi</option>
          </select>
        </div>
        <div class="col-xs-2">
          <select
            v-model="time"
            name="time"
            id="time"
            class="form-control"
            required="true"
          >
            <option selected>Creneau...</option>
            <option value="9">9h - 11h</option>
            <option value="11">11h - 13h</option>
            <option value="13">13h - 15h</option>
            <option value="15">15h - 17h</option>
          </select>
        </div>
      </div>

      <!--<button type="submit">Ajouter</button>-->
      <SubmitButton name="Ajouter" @click="addCompany" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
import axios from "axios";

export default {
  name: "addCompany",

  data() {
    return {
      siret: "",
      name: "",
      adress: "",
      postcode: "",
      city: "",
      member_count: "",
    };
  },

  components: {
    Header,
    BackButton,
    SubmitButton,
  },

  methods: {
    async siretSearch() {
      const siret = this.siret;
      const urlApi = `https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/${siret}`;
      const dataSiret = await fetch(urlApi);
      const responseDataSiret = await dataSiret.json();
      console.log(responseDataSiret);
      this.name = responseDataSiret.etablissement.unite_legale.denomination;
      console.log(this.name);
      this.adress = responseDataSiret.etablissement.geo_l4;
      this.postcode = responseDataSiret.etablissement.code_postal;
      this.city = responseDataSiret.etablissement.libelle_commune;
    },

    addCompany(e) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/company", {
            siret: this.siret,
            name: this.name,
            adress: this.adress,
            postcode: this.postcode,
            city: this.city,
            member_count: Number(this.member_count),
          })
          .then((response) => {
            console.log(response);
            this.$router.push({ name: "adminCompanies" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
};
</script>

<style scoped>
select {
  width: 150px;
}
</style>
