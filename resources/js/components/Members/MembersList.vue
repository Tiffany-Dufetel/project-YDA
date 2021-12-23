<template>
  <!-- member list filtered by company id-->

  <tr>
    <td valign="middle">{{ first_name }}</td>
    <td valign="middle">{{ surname }}</td>
    <td valign="middle">{{ birthday }}</td>
    <td valign="middle">{{ email }}</td>
    <td valign="middle">{{ role }}</td>

    <td>
      <div class="btn-group" role="group">
        <router-link
            :to="{ name: 'individualMember', params: { id: this.id } }"
            class="btn-show"
            >Voir
        </router-link>
        <button class="btn-show" @click="goToUpdate">Modifier</button>
        <!-- <button class="btn btn-primary" @click="verify">Vérifie</button> -->
        <button class="btn-delete" @click="deleteMember(this.id)">
            <ion-icon name="trash"></ion-icon>
        </button>
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
    role: String,
  },
  data() {
    return {
      members: [],
      member: null,
    };
  },
  methods: {
    goToUpdate() {
      this.$router.push("/membre/" + this.id + "/modifier");
    },
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
          .delete(`http://127.0.0.1:8000/api/user/${id}`)
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
