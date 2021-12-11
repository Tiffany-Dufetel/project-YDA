<!--
-- Add product page component
-->

<template>
  <div>
    <Header title="Ajouter un produit ou service" subtitle="...." />
    <form action="post" @submit.prevent="addProduct">
      <!-- item name -->
      <div class="form-group col-md-4">
        <input
          type="text"
          name="name"
          v-model="name"
          placeholder="nom de produit"
        />
      </div>
      <!-- item description -->
      <div class="form-group col-md-4">
        <textarea
          rows="4"
          cols="50"
          type="text"
          name="description"
          v-model="description"
          placeholder="descriptif du produit"
          required="true"
        >
        </textarea>
      </div>
      <!-- item type -->
      <div class="form-group col-md-4">
        <label for="type">Type</label>
        <select
          v-model="type"
          name="type"
          id="type"
          class="form-control"
          required="true"
        >
          <option selected>choisir le type...</option>
          <option value="service">service</option>
          <option value="produit">produit</option>
        </select>
      </div>
      <!-- item type -->
      <div class="form-group col-md-4">
        <label for="category">Categorie</label>
        <select
          v-model="category"
          name="category"
          id="category"
          class="form-control"
          required="true"
        >
          <option selected>choisir la catégorie...</option>
          <option value="service">service</option>
          <option value="produit">produit</option>
        </select>
      </div>

      <input type="submit" class="button is-info" value="Send feedback" />
    </form>
  </div>
</template>

<script>
import Header from "../../../components/ui/Header.vue";
export default {
  name: "AddProduct",
  components: {
    Header,
  },
  data() {
    return {
      crewName: "",
      email: "",
      race: "",
      date: "",
      boat: "",
      boatName: "",
      boat2: "",
      boatName2: "",
      weight: 0,
      data: {},
      message: null,
    };
  },
  methods: {
    async raceNow(event) {
      event.target.reset();
      const raceBooking = JSON.stringify(
        this.crewName,
        this.email,
        this.race,
        this.date,
        this.boat,
        this.boatName,
        this.boat2,
        this.boatName2,
        this.weight
      );
      // create post bosy
      const racePost = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: raceBooking,
      };
      console.log(raceBooking);
      // fetch to backend
      const response = await fetch(
        "http://localhost:4000/members/race",
        racePost
      );
      /// might need rest.JSON?? Look if it arrives on back end
      const data = await response.json();
      // data declarations
      this.crewName = data.crewName;
      this.email = data.email;
      this.race = data.race;
      this.date = data.date;
      this.boat = data.boat;
      this.boatName = data.boatName;
      this.boat2 = data.boat2;
      this.boatName2 = data.boatName2;
      this.weight = data.weight;
      this.message = `You have requested a ${this.data.boat} on ${this.data.date} at ${this.data.race}. We will get back to you ASAP`;
    },
  },
};
</script>
