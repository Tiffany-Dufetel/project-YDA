<!--
-- View company update page component
BACK BUTTON
-->

<template>
  <div>
    <Header title="modifier entreprise" subtitle="update " />
    <BackButton />

    <div class="alert alert-success" v-show="success">
      L'entreprise a bien été mis à jour
    </div>

    <form method="POST" @submit.prevent>
      <!-- Siret number to use government data -->
      <label for="siret">Siret</label><br />
      <input type="text" id="siret" name="siret" v-model="siret" /><br />

      <div v-show="errors && errors.siret">
        <p
          class="text-danger"
          v-for="(error, index) in errors.siret"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="name">Dénomination social</label><br />
      <input type="text" id="name" name="name" v-model="name" /><br />

      <div v-show="errors && errors.name">
        <p
          class="text-danger"
          v-for="(error, index) in errors.name"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="adress">Adresse</label><br />
      <input type="text" id="adress" name="adress" v-model="adress" /><br />

      <div v-show="errors && errors.adress">
        <p
          class="text-danger"
          v-for="(error, index) in errors.adress"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="postCode">Code postal</label><br />
      <input
        type="text"
        id="postCode"
        name="postCode"
        v-model="postcode"
      /><br />

      <div v-show="errors && errors.postcode">
        <p
          class="text-danger"
          v-for="(error, index) in errors.postcode"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

      <label for="city">Ville</label><br />
      <input type="text" id="city" name="city" v-model="city" /><br />

      <div v-show="errors && errors.city">
        <p
          class="text-danger"
          v-for="(error, index) in errors.city"
          :key="index"
        >
          {{ error }}
        </p>
      </div>

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
          <select v-model="day" name="day" id="day" class="form-control">
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
          <select v-model="time" name="time" id="time" class="form-control">
            <option selected>Creneau...</option>
            <option value="09:00 - 11:00">9h - 11h</option>
            <option value="11:00 - 13:00">11h - 13h</option>
            <option value="13:00 - 15:00">13h - 15h</option>
            <option value="15:00 - 17:00">15h - 17h</option>
          </select>
        </div>
      </div>

      <!--<button type="submit">Ajouter</button>-->
      <SubmitButton name="Ajouter" @click="updateCompany" />
    </form>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import SubmitButton from "../../components/ui/buttons/SubmitButton.vue";
export default {
  name: "companyUpdate",
  components: {
    Header,
    SubmitButton,
  },

  data() {
    return {
      companyInfo: {},
      siret: "",
      name: "",
      adress: "",
      postcode: "",
      city: "",
      member_count: "",
      day: "",
      time: "",
      success: false,
      errors: {},
    };
  },

  methods: {
    updateCompany() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/company/" + this.$route.params.id, {
            siret: this.siret,
            name: this.name,
            adress: this.adress,
            postcode: this.postcode,
            city: this.city,
            member_count: Number(this.member_count),
            day: this.day,
            time: this.time,
            _method: "put",
          })
          .then((res) => {
            (this.siret = ""),
              (this.name = ""),
              (this.adress = ""),
              (this.postcode = ""),
              (this.city = ""),
              (this.member_count = ""),
              (this.day = ""),
              (this.time = ""),
              (this.success = true);
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
      });
    },
  },

  async mounted() {
    const response = await axios.get("/api/company/" + this.$route.params.id);
    this.companyInfo = response.data;
    console.log("abc", this.companyInfo);
  },
};
</script>

<style>
</style>
