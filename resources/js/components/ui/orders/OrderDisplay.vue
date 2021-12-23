<template>
  <!-- member list filtered by company id-->

  <tr>
    <td valign="middle">{{ name }}</td>
    <td valign="middle">{{ user_surname }} {{ user_firstname }}</td>
    <td valign="middle">{{ status }}</td>
    <td valign="middle">{{ date_order }}</td>
    <td valign="middle">{{ date_delivery }}</td>
    <td valign="middle">{{ comment }}</td>
    <td valign="middle">{{ pdf }}</td>

    <td>
      <div class="btn-group" role="group">
        <button class="btn-show">Edit</button>
        <button class="btn-delete">
            <ion-icon name="trash"></ion-icon>
        </button>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: {
    name: String,
    user_surname: String,
    user_firstname: String,
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
