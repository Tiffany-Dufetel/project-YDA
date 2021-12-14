<!--
-- Company individual display page component
-->

<template>
  <div>
    <!-- rendre le nom reactive -->
    <Header title="Fiche entreprise" subtitle="" />
  </div>
  <BackButton />
  <AddButton name="Ajouter membre" @click="add"/>

  <div class="card">
      <div class="leftSide">
          <h1>{{name}}</h1>
          <p>{{siret}}</p>

      </div>
      <div class="rightSide">

      </div>
  </div>


</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import AddButton from "../../components/ui/buttons/AddButton.vue";

export default {
    name: "CompanyDisplay",
    components: {
        Header,
        BackButton,
        AddButton,
    },

    data() {
        return{
            siret:this.siret,
            name:this.name,
            adress:this.adress,
            postcode:this.postcode,
            city:this.city,
            member_count:this.member_count,
        }
    },

    props:{
        siret:String,
        name:String,
        adress:String,
        postcode:Number,
        city:String,
        member_count:Number,
    },

   methods: {
    add() {
      this.$router.push({ name: "companiesAddMembers" });
    },
   },

  async mounted() {
    const getCompanyInfos = await axios.get("/api/company");
    this.companyArray = getCompanyInfos.data.data;
    console.log(this.companyArray);
  },
}
</script>

<style>
</style>
