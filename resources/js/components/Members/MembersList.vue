<template>
  <!-- member list filtered by company id-->

        <tr>
          <td valign="middle"><router-link :to="{ name: 'individualMember', params: { id: this.id } }">{{ first_name }}</router-link></td>
          <td valign="middle">{{ surname }}</td>
          <td valign="middle">{{ birthday }}</td>
          <td valign="middle">{{ email }}</td>
          <td valign="middle">{{ role }}</td>

    <td>
      <div class="btn-group" role="group">
        <button class="btn btn-primary" @click="goToUpdate">Modifier</button>
        <button class="btn btn-danger">Effacer</button>
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
        role: String,
    },
      methods: {
        goToUpdate(){
            this.$router.push('/membre/'+ this.id +'/edit')
        },
        verify() {
            this.$router.push({
                name: "FirstConnection",
                /* params: { id: user.id }, */
            });
        },
  },
};
</script>

<style>
</style>
