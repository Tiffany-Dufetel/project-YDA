<!--
-- Navbar asset component
-->

<template>
  <header>
    <nav>
      <ul>
        <!-- YDA Logo -->
        <li>
          <!-- <img alt="YDA logo"  src="../../../assets/logo.JPG"/> -->
        </li>

        <!-- NOT CONNECTED NAVIGATION -->
        <!-- <div :if="!connected"> -->
        <!-- Link Home -->
        <li>
          <a><router-link to="Home">Home</router-link></a>
        </li>
        <!-- Link Log in -->
        <li>
          <a><router-link to="Login">Log in</router-link></a>
        </li>
        <!-- </div> -->

        <!-- CONNECTED NAVIGATION -->
        <!-- <div :if="connected">
          <div :if="admin"></div>
          <div :else-if="member"></div>
          <div :else="company"></div>
        </div> -->

        <!-- Link Contact -->
        <li>
          <a><router-link to="Contact">Contact</router-link></a>
        </li>
        <!-- Sign Out -->
        <!-- <div :if="connected">
          <li>
            <a @click="logOut">Log out</a>
          </li>
        </div> -->
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Navbar",
  /* data() {
    return { isLogged: this.checkIfIsLogged() };
  }, */
  methods: {
    logOut() {
      localStorage.removeItem("token");
      /* this.isLogged = this.checkIfConnected() */
      this.$router.push("Home");
    },
    /* checkIfConnected() */
  },
};
</script>


<style scoped>
body {
  height: 125vh;
  margin-top: 80px;
  padding: 30px;
  background-size: cover;
  font-family: sans-serif;
}
header {
  background-color: #fcfcfc;
  color: #0e1d06;
  position: fixed;
  left: 0;
  right: 0;
  top: 5px;
  height: 70px;
  display: flex;
  align-items: center;
  box-shadow: 0 5px 25px 0 #00000036;
}
header * {
  display: inline;
}
header li {
  margin: 20px;
}
header li a {
  color: rgb(219 144 36);
  text-decoration: none;
}
</style>
