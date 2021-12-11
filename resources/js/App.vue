<template>
  <div id="app" :style="image">
    <!-- Display the nav bar -->
    <Nav />
    <!-- Import the router -->
    <router-view />
    <!-- Display the footer -->
    <Footer />
  </div>
</template>
 
<script>
/** Imports */
import Nav from "./components/assets/Navbar.vue";
import Footer from "./components/assets/Footer.vue";
export default {
  name: "App",
  components: {
    Nav,
    Footer,
  },
  /* data() {
    return {
      isLoggedIn: false,
      image: {
        backgroundImage:
          "url(https://www.sortiraparis.com/images/80/83517/584112-visuel-paris-conciergerie.jpg)",
      },
  },
    created() {
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

