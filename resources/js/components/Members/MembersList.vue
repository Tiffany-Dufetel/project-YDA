<template>
  <div>
    <h1>Members</h1>
    <div v-for="user in arrayUsers" :key="user.id">{{ user.surname }}</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      arrayUsers: [],
    };
  },
  /*setup() {
    const getMembers = async () => {
      let members = await axios.get("/api/user");
      console.log(members.data);
      this.arrayUsers = members.data;
      console.log(this.arrayUsers);
    };
    */
  async mounted() {
    const getMembers = await axios.get("/api/user");
    console.log(getMembers.data);
    this.arrayUsers = getMembers.data.data;
  },

  // getMembers();
};
</script>

<style>
</style>
