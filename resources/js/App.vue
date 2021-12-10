<template>
  <div id="app" :style="image">
    <!-- Display the nav bar -->
    <Nav />
    <!-- Import the router -->
    <Home />
    <!-- Display the footer -->
    <Footer />
  </div>
</template>

<script>
/** Imports */
import Home from "./pages/Home.vue";
import Nav from "./components/assets/Navbar.vue";
import Footer from "./components/assets/Footer.vue";
export default {
  name: "App",
  components: {
    Nav,
    Home,
    Footer,
  },
  data() {
    return {
      image: {
        backgroundImage:
          "url(https://www.sortiraparis.com/images/80/83517/584112-visuel-paris-conciergerie.jpg)",
      },
    };
  },
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
