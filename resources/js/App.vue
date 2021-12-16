<template>
  <div id="app" :style="image">
    <!-- Display the nav bar -->
    <Navbar />
    <!-- Import the router -->
    <router-view />
    <!-- Display the footer -->
    <Footer />
  </div>
</template>

<script>
/** Imports */
import Navbar from "./components/assets/Navbar.vue";
import Footer from "./components/assets/Footer.vue";
import { computed} from "vue";

export default {
  name: "App",
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      isLoggedIn: false,
    }
  },
    /* created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    }, */
    provide() {
        return {
            isLoggedIn : computed(() => this.isLoggedIn),
            setLoginStatus: () => {
                this.isLoggedIn = true;
            },
            removeLoginStatus: () => {
                this.isLoggedIn = false;
            }
        }
    }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  background-repeat: round;
  height: 700px;
}
</style>
