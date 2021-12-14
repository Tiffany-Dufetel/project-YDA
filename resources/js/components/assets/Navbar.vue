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
        <li v-if="userToken == null">
          <a><router-link to="/">Home</router-link></a>
        </li>

        <li v-else>
            <a><router-link to="/admin">Home</router-link></a>
        </li>

        <!-- Link Contact -->
        <li>
          <a><router-link to="/contact">Contact</router-link></a>
        </li>
        <!-- Sign Out -->

        <!-- Link Log in -->
        <li v-if="userToken == null">
            <button class="log" @click="logIn">Log In</button>
        </li>
        <li v-else>
            <button class="log" @click="logOut">Log out</button>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Navbar",
    data(){
        return{
            userToken: null,
        }
    },

    mounted(){
        this.userToken = localStorage.getItem('userToken')
        console.log("token",this.userToken)
    },

    methods: {
        logIn(){
            this.$router.push('/admin')
        },
        logOut() {
            localStorage.removeItem("userToken");
            this.$router.push('/login');
            // window.location.reload()
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

.log{
    background-color: #e78c15;
    border-radius: 5px;
    padding: 5px 20px;
    border: 1px solid #e78c15;
    color: white;
}

.log:hover{
    background-color: black;
    color: #e78c15;
    border: 1px solid #e78c15;
}

</style>
