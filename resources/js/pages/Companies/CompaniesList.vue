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
    <form class="form-inline">
      <input
        class="form-control mr-sm-2"
        type="search"
        placeholder="Search"
        aria-label="Search"
      />
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">
        Search
      </button>
    </form>

    <!-- Companies list -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Siret</th>
          <th>Adresse</th>
          <th>Total de membres</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="company in companyArray" :key="company.id">
          <td>{{ company.name }}</td>
          <td>{{ company.siret }}</td>
          <td>
            {{ company.adress }}, {{ company.postcode }}, {{ company.city }}
          </td>
          <td>{{ company.member_count }}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'individualCompany', params: { id: company.id } }"
                class="btn btn-primary"
                >Edit
              </router-link>
              <button class="btn btn-danger" @click="deleteCompany(company.id)">
                Delete
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
    };
  },
  async mounted() {
    const getCompanies = await axios.get("/api/company");
    this.companyArray = getCompanies.data.data;
    console.log(this.companyArray);
  },
  methods: {
    add() {
      this.$router.push({ name: "adminAddCompany" });
    },
    deleteCompany(id) {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .delete(`/api/company/destroy/${id}`)
          .then((response) => {
            let i = this.company.map((item) => item.id).indexOf(id); // find index of your object
            this.company.splice(i, 1);
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
.search {
  width: 50vw;
}
</style>