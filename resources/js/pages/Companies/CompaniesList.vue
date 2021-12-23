<!--
-- List of companies page component
-->

<template>
  <div class="catalogue_container">
    <Header title="Les entreprises" subtitle="" />
    <BackButton />
    <AddButton name="Ajouter Entreprise" @click="add" />
    <br />

    <!-- Search box -->

    <input
      id="input-search"
      v-model="searchKey"
      class="form-control mr-sm-2"
      type="text"
      placeholder="Rechercher...."
      aria-label="Search"
      autocomplete="off"
    />
    <br />
    <div class="search-result">
      <span v-if="searchKey && filteredList.length == 1">
        {{ filteredList.length }} résultat(s)</span
      >
      <span v-if="filteredList.length >= 2"></span>
    </div>

    <div class="search-result" v-if="filteredList.length == []">
      <h3>Désolé</h3>
      <p>Aucun résultat trouvé</p>
    </div>
    <!-- Companies list -->
    <table class="center-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Siret</th>
          <th>Adresse</th>
          <th>Téléphone</th>
          <th>Nb membres</th>
          <th>Creneau de livraison 1</th>
          <th>Creneau de livraison 2</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="company in filteredList" :key="company.id">
          <td valign="middle">{{ company.name }}</td>
          <td valign="middle">{{ company.siret }}</td>
          <td valign="middle">
            {{ company.adress }}, {{ company.postcode }}, {{ company.city }}
          </td>
          <td valign="middle">{{ company.number }}</td>
          <td valign="middle">{{ company.member_count }}</td>
          <td valign="middle">{{ company.day }} <br>{{ company.time }}</td>
          <td valign="middle">{{ company.dayTwo }} <br> {{ company.timeTwo }}</td>
          <td valign="middle">
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualCompany', params: { id: company.id } }"
                class="btn-show"
                >Voir
              </router-link>
              <button class="btn-delete" @click="deleteCompany(company.id)">
                <ion-icon name="trash"></ion-icon>
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
      companies: [],
      company: null,
      searchKey: "",
    };
  },
  computed: {
    /** Search box */
    filteredList() {
      return this.companies.filter((company) => {
        return (
          company.name.toLowerCase().includes(this.searchKey.toLowerCase()) ||
          company.city.toLowerCase().includes(this.searchKey.toLowerCase())
        );
      });
    },
  },
  methods: {
    /** Retrieve full list of companies from database */
    async retrieveCompanies() {
      const getCompanies = await axios.get("/api/company");
      this.companies = getCompanies.data.data;
      console.log(this.companies);
    },
    /** Refresh the list when changes are made */
    async refreshList() {
      this.retrieveCompanies();
      this.company = null;
    },
    /** Go to "add new company" page */
    add() {
      this.$router.push({ name: "adminAddCompany" });
    },
    /** Delete a specific company */
    deleteCompany(company_id) {
      if (confirm("Etes-vous sur d'effacer cette entreprise ?")) {
        axios
          .delete(`api/company/${company_id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => this.refreshList());
      }
    },
  },
  /** Mount with the full company list */
  mounted() {
    this.retrieveCompanies();
  },
};
</script>

<style scoped>
.search {
  width: 50vw;
}
</style>
