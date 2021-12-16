<template>
    <!-- member list filtered by company id-->

        <tr>
          <td valign="middle"><router-link :to="{ name: 'individualMember', params: { id: this.id } }">{{ first_name }}</router-link></td>
          <td valign="middle">{{ surname }}</td>
          <td valign="middle">{{ birthday }}</td>
          <td valign="middle">{{ email }}</td>

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

</template>

<script>

export default {
    props: {
        id: Number,
        first_name: String,
        surname: String,
        birthday: String,
        email: String,
    }
};
</script>

<style>
</style>
