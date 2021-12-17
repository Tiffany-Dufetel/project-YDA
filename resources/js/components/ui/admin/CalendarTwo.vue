<!--
-- CalendarTwo UI component
-->

<template>
  <div>
    <!-- développer affichage conditionnel ici -->
    <div></div>

    <!-- Presentation table for calendar -->
    <div class="table-responsive-md d-flex justify-content-center mt-4">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Lundi</th>
            <th scope="col">Mardi</th>
            <th scope="col">Mercredi</th>
            <th scope="col">Jeudi</th>
            <th scope="col">Vendredi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="company in companies" :key="company.id">
            <td>
              <!-- v-if="company.day === 'monday'" -->
              <!-- {{ company.name }}<br />{{ company.time }}  -->{{ monday }}
            </td>
            <!-- <td v-else-if="company.day === 'tuesday'">
              {{ company.name }}<br />{{ company.time }}
            </td>
            <td v-else-if="company.day === 'wednesday'">
              {{ company.name }}<br />{{ company.time }}
            </td>
            <td v-else-if="company.day === 'thursday'">
              {{ company.name }}<br />{{ company.time }}
            </td>
            <td v-else-if="company.day === 'friday'">
              {{ company.name }}<br />{{ company.time }}
            </td>
            <div v-else></div> -->
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "CalendarTwo",
  data() {
    return {
      companies: [],
    };
  },
  // fetch the list of companies on view creation
  async mounted() {
    const companyList = await axios.get("/api/company");
    this.companies = companyList.data.data;
    // check that we have the data
    console.log(this.companies);
    /* if (companyList.day === "lundi") {
        
    } */
  },
  computed: {
    monday() {
      return company.day === "monday"
        ? `${company.name} <br/> ${company.time}`
        : "";
    },
  },
};
</script>

<style scoped>
table {
  width: 70%;
}
</style>