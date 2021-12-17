<!--
-- List of companies page component
-->

<template>
  <div>
    <Header title="Les entreprises" subtitle="" />
    <BackButton />
    <AddButton name="Ajouter Entreprise" @click="add" />
    <br />

    <!-- Search box -->

      <input
      v-model="searchKey"
        class="form-control mr-sm-2"
        type="search"
        placeholder="Rechercher...."
        aria-label="Search"
        autocomplete="off"
      />
      <br/>
      <div>
      <span v-if="searchKey && filteredList.lenght == 1">
      {{filteredList.lenght}}résultat</span> <span v-if="filteredList.lenght >= 2">s</span>
      </div>
     <!-- <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">
        Search
      </button>
      -->
   <div v-if="filteredList.lenght == []">
   <h3>Désolé</h3>
   <p>Aucun résultat trouvé</p>
   </div>
    <!-- Companies list -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Siret</th>
          <th>Adresse</th>
          <th>Total de membres</th>
          <th>Creneau de livraison</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="company in filteredList" :key="company.id">
        <!-- <tr v-for="company in companies" :key="company.id"> -->
          <td>{{ company.name }}</td>
          <td>{{ company.siret }}</td>
          <td>
            {{ company.adress }}, {{ company.postcode }}, {{ company.city }}
          </td>
          <td>{{ company.member_count }}</td>
          <td>{{ company.day }} entre {{ company.time }}h et</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualCompany', params: { id: company.id } }"
                class="btn btn-primary"
                >Voir
              </router-link>
              <button class="btn btn-danger" @click="deleteCompany(company.id)">
                Effacer
              </button>
            </div>
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
  data() {
    return {
      companyArray: [],
      searchKey: '',
      companies: [],
    };
  },


  async mounted() {
    const getCompanies = await axios.get("/api/company");
    this.companies = getCompanies.data.data;
    console.log(this.companies);
  },

  computed:{
  filteredList(){

      return this.companyArray.filter((company) => {
          return company.name.toLowerCase().includes(this.searchKey.toLowerCase()) || company.city.toLowerCase().includes(this.searchKey.toLowerCase());
      })
  }
  },
  methods: {
    add() {
      this.$router.push({ name: "adminAddCompany" });
    },
    deleteCompany(company_id) {
      if (confirm("Etes-vous sur d'effacer cette entreprise ?")) {
        axios
          .delete(`/api/company/destroy/${id}`)
          .then((response) => {
            let i = this.companyArray.map((item) => item.id).indexOf(id); // find index of your object
            this.companyArray.splice(i, 1);
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
  },
};
</script>

<style scoped>
.search {
  width: 50vw;
}
</style>
