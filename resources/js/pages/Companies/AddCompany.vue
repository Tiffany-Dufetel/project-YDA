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
<div class="container">

    <form class="contentForm" method="PUT" @submit.prevent>
        <div class="formContent">
      <!-- Siret number to use government data -->
      <label for="siret">Siret</label>
      <input
        type="text"
        id="siret"
        name="siret"
        v-model="siret"
        placeholder="Saisissez un siret et pressez 'Entrer'"
        class="inputText marginBot"
        v-on:keypress.enter="siretSearch"
        @keydown.enter.prevent="siretSearch"
      />

      <div v-show="errors && errors.siret">
        <p
          class="text-danger"
          v-for="(error, index) in errors.siret"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="name">Dénomination social</label>
      <input class="inputText marginBot" type="text" id="name" name="name" v-model="name" />

      <div v-show="errors && errors.name">
        <p
          class="text-danger"
          v-for="(error, index) in errors.name"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="adress">Adresse</label>
      <input class="inputText marginBot" type="text" id="adress" name="adress" v-model="adress" />

      <div v-show="errors && errors.adress">
        <p
          class="text-danger"
          v-for="(error, index) in errors.adress"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="postCode">Code postal</label>
      <input
        type="text"
        id="postCode"
        name="postCode"
        class="inputText marginBot"
        v-model="postcode"
      />

      <div v-show="errors && errors.postcode">
        <p
          class="text-danger"
          v-for="(error, index) in errors.postcode"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="city">Ville</label>
      <input class="inputText marginBot" type="text" id="city" name="city" v-model="city" />

      <div v-show="errors && errors.city">
        <p
          class="text-danger"
          v-for="(error, index) in errors.city"
          :key="index"
        >
          {{ error }}
        </p>
      </div>
      </div>
      <div class="formContent">

      <label for="number">Numéro de contact</label>
      <input class="inputText marginBot" type="number" id="number" name="number" v-model="number" />

      <label for="member_count">Nombre d'employés</label>
      <input
        type="number"
        id="member_count"
        name="member_count"
        class="inputText marginBot"
        v-model="member_count"
      />

      <!-- Preferable day and time ONE -->
      <label for="day">Jour et creneau horaire préféré 1</label>
      <div >
        <div class="col-xs-3">
          <select class="inputText marginBot" v-model="day" name="day" id="day">
            <option selected>choisir le jour...</option>
            <option value="monday">Lundi</option>
            <option value="tuesday">Mardi</option>
            <option value="wednesday">Mercredi</option>
            <option value="thursday">Jeudi</option>
            <option value="friday">Vendredi</option>
          </select>
        </div>
        <div class="col-xs-2">
          <label for="time">Créneau de passage</label>
          <select class="inputText marginBot" v-model="time" name="time" id="time">
            <option selected>Creneau...</option>
            <option value="09:00 - 11:00">9h - 11h</option>
            <option value="11:00 - 13:00">11h - 13h</option>
            <option value="13:00 - 15:00">13h - 15h</option>
            <option value="15:00 - 17:00">15h - 17h</option>
          </select>
        </div>
      </div>

      <!-- Preferable day and time TWO -->
      <label for="dayTwo">Jour et creneau horaire préféré 2 </label>
      <div >
        <div class="col-xs-3">
          <select
            v-model="dayTwo"
            name="dayTwo"
            id="dayTwo"
            class="inputText marginBot"

          >
            <option selected>choisir le jour...</option>
            <option value="monday">Lundi</option>
            <option value="tuesday">Mardi</option>
            <option value="wednesday">Mercredi</option>
            <option value="thursday">Jeudi</option>
            <option value="friday">Vendredi</option>
          </select>
        </div>
        <div class="col-xs-2">
          <label for="timeTwo">Créneau de passage</label>
          <select
            v-model="timeTwo"
            name="timeTwo"
            id="timeTwo"
            class="inputText marginBot"

          >
            <option selected>Creneau...</option>
            <option value="09:00 - 11:00">9h - 11h</option>
            <option value="11:00 - 13:00">11h - 13h</option>
            <option value="13:00 - 15:00">13h - 15h</option>
            <option value="15:00 - 17:00">15h - 17h</option>
          </select>
        </div>
      </div>

      <!--<button type="submit">Ajouter</button>-->
      <SubmitButton name="Ajouter" @click="addCompany" />
      </div>
    </form>
    </div>
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
      number: "",
      day: "",
      time: "",
      dayTwo: "",
      timeTwo: "",
      success: false,
      errors: {},
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
    seeList() {
      this.$router.push({ name: "adminCompanies" });
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
            number: this.number,
            day: this.day,
            time: this.time,
            dayTwo: this.day,
            timeTwo: this.time,
          })
          .then((res) => {
            (this.siret = ""),
              (this.name = ""),
              (this.adress = ""),
              (this.postcode = ""),
              (this.city = ""),
              (this.member_count = ""),
              (this.number = ""),
              (this.day = ""),
              (this.time = ""),
              (this.dayTwo = ""),
              (this.timeTwo = ""),
              (this.success = "true");
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          })
          .finally(() => this.seeList());
      });
    },
  },
};
</script>

<style scoped>
select {
  width: 150px;
}

.container{
    display: flex;
    justify-content: center;
    flex-direction: column;
}

.formContent{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    letter-spacing: 4px;
    font-size:20px;
    border: 1px solid transparent;
    border-radius: 10px;
    width: 550px;
    box-shadow: 0.3em 0.3em 1em #acacac, -0.3em -0.3em 1em #dbdbdb;
    padding: 30px;
    margin-right: 70px;
}

.marginTop{
    margin-top: 15px;
}

.marginBot{
    margin-bottom: 15px;
}

.inputText{
    border-radius: 10px;
    height: 2.5rem;
    outline: none;
    border: 1px solid black;
    width: 450px;
    color: #333333;

}

.inputText:focus{
    border: 2px solid #e78c15;
    background-color: #fafafa;
}
.contentForm{
    display: flex;

}

@media only screen and (max-width: 1400px){
    .contentForm{
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.formContent{
    margin-bottom: 30px;
}
}
</style>
