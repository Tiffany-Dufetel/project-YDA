<!--
-- CalendarTwo UI component
-->

<template>
  <div>
    <div class="table-responsive-md d-flex justify-content-center mt-4">
      <!-- Day Table -->
      <div
        v-for="(dayLabel, day) in weekDays"
        :key="day"
        class="table-responsive-md d-flex justify-content-center mt-4"
      >
        <table class="table">
          <thead>
            <tr>
              <th scope="col">{{ dayLabel }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(appointment, index) in companiesPlanning[day]"
                :key="index">
              <td

              >
                {{ appointment.name }}<br />{{ appointment.time }}<br>
              </td>
            </tr>
            <tr>
                <td v-if="!companiesPlanning[day]">Aucun rendez-vous ce jour</td>
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
      weekDays: {
        monday: "Lundi",
        tuesday: "Mardi",
        wednesday: "Mercredi",
        thursday: "Jeudi",
        friday: "Vendredi",
      },
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
    companiesPlanning() {
      let planning = {};

      this.companies.forEach((company) => {
        if (!Array.isArray(planning[company.day])) {
          planning[company.day] = [];
        }

        planning[company.day].push({ name: company.name, time: company.time });

        if (!Array.isArray(planning[company.dayTwo])) {
          planning[company.dayTwo] = [];
        }

        planning[company.dayTwo].push({
          name: company.name,
          time: company.time,
        });
      });

      return planning;
    },
  },
};
</script>

<style scoped>
table {
  width: 70%;
}
</style>
