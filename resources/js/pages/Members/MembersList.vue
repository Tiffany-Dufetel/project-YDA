<!--
-- List of members page component
-->
<template>
  <div class="catalogue_container">
    <Header title="name of company" subtitle="Tous les membres" />
    <BackButton />
    <CatalogueDisplay />
    <AddButton name="Ajouter Produit" @click="add" />

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
          <th>Nom</th>
          <th>Prénom</th>
          <th>Date de naissance</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user,index) in arrayUsers" :key="index">
          <td valign="middle"><router-link :to="{ name: 'individualMember', params: { id: user.id } }">{{ user.first_name }}</router-link></td>
          <td valign="middle">{{ user.surname }}</td>
          <td valign="middle">{{ user.birthday }}</td>
          <td valign="middle">{{ user.email }}</td>

          <td>
            <div class="btn-group" role="group">
              <button class="btn btn-primary">
                Edit
              </button>
              <button class="btn btn-danger">
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
import axios from "axios";
import Header from "../../components/ui/Header.vue";
export default {
  name: "MembersList",
  components: {
    Header,
  },
  data() {
    return {
      arrayUsers: [],
    };
  },

  async mounted() {
    const getMembers = await axios.get("/api/user");
    console.log('okk',getMembers.data);
    this.arrayUsers = getMembers.data;
  },

  // getMembers();
};
</script>

<style>
</style>
