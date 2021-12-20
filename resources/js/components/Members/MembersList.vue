<template>
  <!-- member list filtered by company id-->

  <tr>
    <td valign="middle">
      <router-link
        :to="{ name: 'individualMember', params: { id: this.id } }"
        >{{ first_name }}</router-link
      >
    </td>
    <td valign="middle">{{ surname }}</td>
    <td valign="middle">{{ birthday }}</td>
    <td valign="middle">{{ email }}</td>

    <td>
      <div class="btn-group" role="group">
        <button class="btn btn-primary">Modifier</button>

        <button class="btn btn-danger" @click="deleteMember(this.id)">
          Effacer
        </button>

        <button class="btn btn-primary" @click="verify">Vérifie</button>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: {
    id: Number,
    first_name: String,
    surname: String,
    birthday: String,
    email: String,
  },
  data() {
    return {
      members: [],
      member: null,
    };
  },
  methods: {
    /** Retrieve full list of companies from database */
    async retrieveMembers() {
      const getMembers = await axios.get("/api/user");
      this.members = getMembers.data.data;
      console.log(this.members);
    },
    /** Refresh the list when changes are made */
    async refreshList() {
      this.retrieveMembers();
      this.member = null;
    },
    verify() {
      this.$router.push({
        name: "FirstConnection",
        /* params: { id: user.id }, */
      });
    },
    /** Delete a specific member */
    deleteMember(id) {
      if (confirm("Etes-vous sur d'effacer ce membre ?")) {
        axios
          .delete(`api/user/${id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .finally(() => this.refreshList());
      }
    },
    /** Mount with the full company list */
    mounted() {
      this.retrieveMembers();
    },
  },
};
</script>

<style>
</style>
