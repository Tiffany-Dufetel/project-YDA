<!--
-- Navbar asset component
-->

<template>
  <div class="dashboard">
    <div class="dashboard-nav">
      <header>
        <div class="brand-logo">
          <img alt="YDA logo" src="../../assets/logo-orange.png" />
        </div>
      </header>
      <nav>
        <div class="dashboard-nav-list">
          <!-- link to home logged -->
          <router-link
            to="/yda"
            class="dashboard-nav-item"
            v-if="isLoggedIn.value"
            >Accueil</router-link
          >

          <!-- link to home not logged -->
          <router-link to="/" class="dashboard-nav-item" v-else
            >Accueil</router-link
          >

          <!-- link to catalogue -->
          <router-link
            to="/catalogue"
            class="dashboard-nav-item"
            v-if="(isLoggedIn.value && role == 'admin') || role == 'member'"
            >Catalogue</router-link
          >

          <!-- link to companies -->
          <router-link
            to="/entreprises"
            class="dashboard-nav-item"
            v-if="isLoggedIn.value"
            >Entreprises</router-link
          >

          <!-- link to orders -->
          <router-link
            to="/commandes"
            class="dashboard-nav-item"
            v-if="isLoggedIn.value"
            >Commandes</router-link
          >

          <!-- link to orders -->
          <router-link
            to="/actualités"
            class="dashboard-nav-item"
            v-if="isLoggedIn.value"
            >Actualités</router-link
          >
        </div>
        <div class="nav-item-divider"></div>
        <!-- button Login logout -->
        <div class="btn-log">
          <div v-if="isLoggedIn.value">
            <button @click="logOut">Déconnexion</button>
          </div>
          <div v-else>
            <button @click="logIn">Connexion</button>
          </div>
        </div>
        <div class="contact-info">
          <small
            >&copy; Your Daily Assistant<br />
            <a href="mailto:assistantes@your-daily-assistant.fr"
              >assistantes@your-daily-assistant.fr</a
            ><br />
            06 43 88 43 82
          </small>
        </div>

        <div class="container-icons">
          <!-- logo social network -->
          <ion-icon name="logo-facebook" class="mr-1" @click="fb"></ion-icon>
          <ion-icon
            name="logo-instagram"
            class="mr-1"
            @click="insta"
          ></ion-icon>
          <ion-icon name="logo-linkedin" @click="linkedIn"></ion-icon>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      userToken: null,
      role: "",
    };
  },
  inject: ["isLoggedIn", "removeLoginStatus"],

  async mounted() {
    this.userToken = localStorage.getItem("userToken");
    console.log("token", this.userToken);

    const getUser = await axios.get("/api/login");
    this.role = getUser.data.role;
  },

  updated() {
    console.log(this.isLoggedIn);
  },

  methods: {
    logIn() {
      this.$router.push("/login");
    },
    logOut() {
      localStorage.removeItem("userToken");
      this.removeLoginStatus();
      this.$router.push("/login");
      // window.location.reload()
    },
    fb() {
      window.open("https://www.facebook.com/yda.yourdailyassistant/");
    },
    insta() {
      window.open("https://www.instagram.com/yda.yourdailyassistant/");
    },
    linkedIn() {
      window.open(
        "https://www.linkedin.com/company/yourdailyassistant/posts/?feedView=all"
      );
    },
  },
};
</script>


<style>
nav {
  display: block;
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

.dashboard {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  min-height: 100vh;
  font-size: 18px;
}

.dashboard-app {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-flex: 2;
  -webkit-flex-grow: 2;
  -ms-flex-positive: 2;
  flex-grow: 2;
  margin-top: 84px;
}

.dashboard-content {
  -webkit-box-flex: 2;
  -webkit-flex-grow: 2;
  -ms-flex-positive: 2;
  flex-grow: 2;
  padding: 25px;
}

.dashboard-nav {
  min-width: 238px;
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  overflow: auto;
  background-color: #373193;
}

.dashboard-compact .dashboard-nav {
  display: none;
}

.dashboard-nav header {
  min-height: 84px;
  padding: 8px 27px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.dashboard-nav {
  background-color: #000000;
}

.dashboard-nav a {
  color: rgb(255, 255, 255);
}

.dashboard-nav-list {
  margin: 7vh 0;
}

header {
  background-color: #db9024;
}
.brand-logo {
  font-family: "Nunito", sans-serif;
  font-weight: bold;
  font-size: 20px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  color: #515151;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.brand-logo img {
  width: 15vh;
  padding: 20px 0;
}

.dashboard-nav-item {
  min-height: 56px;
  padding: 8px 20px 8px 70px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  letter-spacing: 0.02em;
  transition: ease-out 0.5s;
}

.dashboard-nav-item i {
  width: 36px;
  font-size: 19px;
  margin-left: -40px;
}

.dashboard-nav-item:hover {
  background: rgba(100, 100, 100, 0.25);
  color:#e78c15;
}

.nav-item-divider {
  height: 1px;
  margin: 1rem 0;
  overflow: hidden;
  background-color: rgba(236, 238, 239, 0.3);
}

ion-icon {
  cursor: pointer;
  padding: 5px;
}

.container-icons {
  text-align: center;
}

.contact-info {
  text-align: center;
  line-height: 17px;
  margin: 20px 10px;
  color: #dddddd;
}

/* @media (min-width: 992px) {
    .dashboard-app {
        margin-left: 238px;
    }

  .dashboard-compact .dashboard-app {
    margin-left: 0;
  }
}

@media (max-width: 768px) {
  .dashboard-content {
    padding: 15px 0px;
  }
}

@media (max-width: 992px) {
  .dashboard-nav {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    z-index: 1070;
  }

  .dashboard-nav.mobile-show {
    display: block;
  }
}

@media (max-width: 992px) {
  .dashboard-nav header .menu-toggle {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
  }
}

@media (min-width: 992px) {
  .dashboard-toolbar {
    left: 238px;
  }

    .dashboard-compact .dashboard-toolbar {
        left: 0;
    }
} */
</style>
