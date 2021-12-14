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
        <!-- Link Home -->
        <li>
          <a><router-link to="/">Home</router-link></a>
        </li>
        <!-- Link Log in -->
        <li>
          <a><router-link to="/login">Log in</router-link></a>
        </li>
        <!-- Link Contact -->
        <li>
          <a><router-link to="/contact">Contact</router-link></a>
        </li>
        <!-- Sign Out -->
        <li>
          <a @click="logOut">Log out</a>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Navbar",
  methods: {
    logOut() {
      localStorage.removeItem("token");
    },
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
