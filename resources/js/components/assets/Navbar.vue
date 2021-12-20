<!--
-- Navbar asset component
-->

<template>
  <header>
    <nav>
      <div class="container">
        <!-- YDA Logo -->
        <div class="logo-container">
          <img alt="YDA logo" src="../../assets/logo-orange.png" />
        </div>
        <ul>
          <!-- Link Home -->
          <li v-if="isLoggedIn.value">
            <a><router-link to="/YDA">Accueil</router-link></a>
          </li>

          <li v-else>
            <a><router-link to="/">Accueil</router-link></a>
          </li>

          <!-- Link catalogue -->
          <li v-if="isLoggedIn.value">
            <a><router-link to="/catalogue">Catalogue</router-link></a>
          </li>

          <!-- <div v-if="user.id == 'manager'"> -->
          <!-- Link companies -->
          <li v-if="isLoggedIn.value">
            <a><router-link to="/entreprises">Entreprises</router-link></a>
          </li>
          <!-- </div> -->

          <!-- Link orders -->
          <li v-if="isLoggedIn.value">
            <a><router-link to="/commandes">Commandes</router-link></a>
          </li>

          <!-- Link Contact -->
          <li>
            <a><router-link to="Contact">Contact</router-link></a>
          </li>
        </ul>

        <!-- Link Log in -->
        <div class="btn-log">
          <div v-if="isLoggedIn.value">
            <button @click="logOut">Déconnexion</button>
          </div>
          <div v-else>
            <button @click="logIn">Log In</button>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      userToken: null,
    };
  },
  inject: ["isLoggedIn", "removeLoginStatus"],

  async mounted() {
    this.userToken = localStorage.getItem("userToken");
    console.log("token", this.userToken);

    /* const response = await axios.get("/api/user");
    this.id = response.data.id; */
  },

  updated() {
    console.log(this.isLoggedIn);
  },

  methods: {
    logIn() {
      this.$router.push("/admin");
    },
    logOut() {
      localStorage.removeItem("userToken");
      this.removeLoginStatus();
      this.$router.push("/login");
      // window.location.reload()
    },
  },
};
</script>


<style scoped>
.container {
  background-color: black;
  width: 300px;
  position: fixed;
  height: 100%;
  left: 0;
  padding: 0;
}

.container img {
  width: 200px;
}

.container ul {
  margin-top: 40px;
}

.logo-container {
  text-align: center;
  background-color: #db9024;
  padding: 35px;
}

ul {
  list-style: none;
  padding-right: 50px;
  margin-bottom: 0px;
}

li {
  padding: 15px 0;
}

li a {
  color: white;
  font-size: 20px;
  padding-left: 15px;
}

nav a.router-link-exact-active {
  border-left: 4px solid #db9024;
}

.btn-log {
  text-align: center;
  margin-top: 40px;
}

.btn-log button {
  font-size: 20px;
  text-transform: uppercase;
  background-color: #e78c15;
  border-radius: 5px;
  padding: 5px 20px;
  border: 1px solid #e78c15;
  color: white;
}

.btn-log button:hover {
  background-color: white;
  color: #e78c15;
  border: 1px solid #e78c15;
}
/* body {
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

.log {
  background-color: #e78c15;
  border-radius: 5px;
  padding: 5px 20px;
  border: 1px solid #e78c15;
  color: white;
}

.log:hover {
  background-color: black;
  color: #e78c15;
  border: 1px solid #e78c15;
} */
</style>
