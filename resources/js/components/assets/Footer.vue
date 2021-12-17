<!--
-- Footer asset component
-->

<template>
  <footer class="flex-shrink-0 py-1 bg-dark text-white-50">
    <div class="container text-center">
      <div class="d-flex justify-content-around p-3 text-white">
        <div class="p-2 font">&copy; Your Daily Assistant</div>
        <div class="p-2 font">
          assistantes@your-daily-assistant.fr<br />06 43 88 43 82
        </div>
        <div class="p-2">
          <div class="d-flex justify-content-around p-3 text-white">
            <ion-icon name="logo-facebook" class="mr-1" @click="fb"></ion-icon>
            <ion-icon
              name="logo-instagram"
              class="mr-1"
              @click="insta"
            ></ion-icon>
            <ion-icon name="logo-linkedin" @click="linkedIn"></ion-icon>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "footer",
  methods: {
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

<style scoped>
ion-icon {
  font-size: 32px;
}
</style>
