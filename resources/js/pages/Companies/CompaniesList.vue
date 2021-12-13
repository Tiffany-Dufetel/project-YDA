<!--
-- List of companies page component
-->

<!-- EXEMPLE DE CODE - A MODIFIER -->

<template>
  <div>
    <Header title="Les entreprises" subtitle="" />
    <BackButton />
    <AddButton name="Ajouter Entreprise" @click="add" />
    <br />
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Siret</th>
          <th>Raison sociale</th>
          <th>Adresse</th>
          <th>Code Postal</th>
          <th>Ville</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="company in companyArray" :key="company.id">
          <td>{{ company.siret }}</td>
          <td>{{ company.name }}</td>
          <td>{{ company.adress }}</td>
          <td>{{ company.postcode }}</td>
          <td>{{ company.city }}</td>
          <td>{{ company.member_count }}</td>
          <td>
            <!--<div class="btn-group" role="group">
              <router-link
                :to="{ name: 'editbook', params: { id: company.id } }"
                class="btn btn-primary"
                >Edit
              </router-link>
              <button class="btn btn-danger" @click="deleteBook(book.id)">
                Delete
              </button>
            </div>-->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import AddButton from "../../components/ui/buttons/AddButton.vue";

export default {
  name: "companyList",
  components: {
    Header,
    BackButton,
    AddButton,
  },

  data(){
      return{
          companyArray:[],

      }
  },


 async mounted(){
        const getCompany = await axios.get("/api/company");
        this.companyArray=getCompany.data.data;
 },


};
</script>
