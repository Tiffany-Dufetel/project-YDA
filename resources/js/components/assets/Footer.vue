<!--
-- Footer asset component
-->

<template>footer</template>

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
