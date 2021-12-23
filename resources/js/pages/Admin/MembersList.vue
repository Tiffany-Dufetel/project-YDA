<!--
-- List of members page component
-->
<template>
  <div class="catalogue_container">
    <Header title="Tous les membres" subtitle="Vous pouvez les gérer ici" />
    <br />

    <BackButton />
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
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Date de naissance</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <MembersList
          v-for="(user, index) in filterUsers"
          :key="index"
          :id="user.id"
          :first_name="user.first_name"
          :surname="user.surname"
          :birthday="user.birthday"
          :email="user.email"
        />
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import Header from "../../components/ui/Header.vue";
import BackButton from "../../components/ui/buttons/BackButton.vue";
import MembersList from "../../components/Members/MembersList.vue";

export default {
  //   name: "MembersList",
  components: {
    Header,
    BackButton,
    MembersList: MembersList,
  },

  async mounted() {
    const loggedResponse = await axios.get("/api/login");
    this.companyId = loggedResponse.data.company_id;

    const response = await axios.get("/api/user");
    const users = response.data;

    this.filterUsers = users.filter(
      (user) => user.company_id === this.companyId
    );

    console.log("filter", this.filterUsers);
  },

  // getMembers();
};
</script>

<style>
</style>
