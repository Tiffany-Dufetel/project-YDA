<!--
-- CalendarTwo UI component
-->

<template>
  <div>
    <div class="table-responsive-md d-flex justify-content-center mt-4">
      <!-- Monday Table -->
      <div class="table-responsive-md d-flex justify-content-center mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Lundi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- Monday -->
              <div v-for="company in companies" :key="company.id">
                <td
                  v-if="company.day === 'monday' || company.dayTwo === 'monday'"
                >
                  {{ company.name }}<br />{{ company.time }}
                </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Tuesday Table -->
      <div class="table-responsive-md d-flex justify-content-center mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Mardi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- Tuesday -->
              <div v-for="company in companies" :key="company.id">
                <td
                  v-if="
                    company.day === 'tuesday' || company.dayTwo === 'tuesday'
                  "
                >
                  {{ company.name }}<br />{{ company.time }}
                </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Wednesday Table -->
      <div class="table-responsive-md d-flex justify-content-center mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Mercredi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- Wednesday -->
              <div v-for="company in companies" :key="company.id">
                <td
                  v-if="
                    company.day === 'wednesday' ||
                    company.dayTwo === 'wednesday'
                  "
                >
                  {{ company.name }}<br />{{ company.time }}
                </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Thursday Table -->
      <div class="table-responsive-md d-flex justify-content-center mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Jeudi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- Thursday -->
              <div v-for="company in companies" :key="company.id">
                <td
                  v-if="
                    company.day === 'thursday' || company.dayTwo === 'thursday'
                  "
                >
                  {{ company.name }}<br />{{ company.time }}
                </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Friday Table -->
      <div class="table-responsive-md d-flex justify-content-center mt-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Vendredi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!-- Friday -->
              <div v-for="company in companies" :key="company.id">
                <td
                  v-if="company.day === 'friday' || company.dayTwo === 'friday'"
                >
                  {{ company.name }}<br />{{ company.time }}
                </td>
              </div>
            </tr>
          </tbody>
        </table>
      </div>
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
    /* if (companyList.day === "lundi") {


    } */
  },
  computed: {
    /* monday() {
      return this.company.day === "monday"
        ? `${this.company.name} <br/> ${this.company.time}`
        : "";
    }, */
  },
};
</script>

<style scoped>
table {
  width: 70%;
}
</style>
