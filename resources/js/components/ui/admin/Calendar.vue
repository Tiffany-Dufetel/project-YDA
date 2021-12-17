<!--
-- Calendar UI component
-->

<template>
  <!-- Calendar displaying upcoming events -->
  <div class="d-flex justify-content-center mt-5 mb-1">
    <!-- :time-from="9 * 60"
        :time-to="19 * 60"
        :time-step="60" -->
    <vue-cal
      :time="false"
      :onEventClick="viewCompany"
      hide-weekends
      style="height: 350px; width: 80%"
      :clickToNavigate="true"
    />
  </div>
</template>

<script>
import axios from "axios";
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
export default {
  name: "Calendar",
  components: {
    VueCal,
  },
  data() {
    return {
      companies: [],
    };
  },
  methods: {
    // A FAIRE
    viewCompany(event, e) {
      // HOW CAN WE SEE THIS WITH the ID ?
      this.$router.push({ name: "individualCompany" }, e.$id);
    },
  },
};
</script>

<style>
</style>