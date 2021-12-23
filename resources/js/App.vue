<template>
  <div id="app" :style="image">
    <!-- Display the nav bar -->
    <Navbar />
    <!-- Import the router -->
    <div class="router-view">
        <router-view />
    </div>
    <!-- Display the footer -->
    <!-- <Footer /> -->
  </div>
</template>

<script>
/** Imports */
import Navbar from "./components/assets/Navbar.vue";
// import Footer from "./components/assets/Footer.vue";
import { computed} from "vue";

export default {
  name: "App",
  components: {
    Navbar,
    // Footer,
  },
  data() {
    return {
      isLoggedIn: false,
      checkRole: "",
      role: "",
    }
  },


mounted(){


    const userToken = localStorage.getItem('userToken')
    if (userToken == null){
        return this.isLoggedIn = false
    } else {
        return this.isLoggedIn = true
    };


},

    provide() {
        return {
            isLoggedIn : computed(() => this.isLoggedIn),
            setLoginStatus: () => {
                this.isLoggedIn = true;
            },
            removeLoginStatus: () => {
                this.isLoggedIn = false;
            },

            checkRole: computed(() => this.checkRole),
            whatRole: ()=>{
                const getUser = axios.get("/api/login");
                console.log('role',this.role);
                this.checkRole = getUser.data.role;
            }
        }
    }
};
</script>

<style>
#app{
    display: flex;
    font-weight: lighter;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    background-color: rgb(250, 250, 250);
}

#app a {
    text-decoration: none;
}

.router-view{
    margin-left: 300px;
}
/* #app { */
  /* font-family: Avenir, Helvetica, Arial, sans-serif; */
  /* -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale; */
  /* text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  background-repeat: round;
  height: 700px; */
/* } */

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
