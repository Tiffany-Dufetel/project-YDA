<template>
  <!-- member list filtered by company id-->

  <tr>
    <td valign="middle">{{ status }}</td>
    <td valign="middle">{{ date_order }}</td>
    <td valign="middle">{{ date_delivery }}</td>
    <td valign="middle">{{ comment }}</td>
    <td valign="middle">{{ pdf }}</td>

    <td>
      <div class="btn-group" role="group">
        <button class="btn btn-primary">Edit</button>
        <button class="btn btn-danger">Delete</button>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: {
    id: Number,
    status: String,
    date_order: Date,
    date_delivery: Date,
    comment: String,
    pdf: String,
  },
};
</script>

<style>
</style>
