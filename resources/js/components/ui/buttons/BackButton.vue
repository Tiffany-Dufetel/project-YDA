<!--
-- Back comment UI component
-->

<template>
  <div>
    <!-- Back button -->
    <ion-icon
      name="return-up-back-outline"
      size="large"
      @click="back"
    ></ion-icon>
  </div>
</template>

<script>
export default {
  name: "BackButton",
  methods: {
    back() {
      this.$router.go(-1);
    },
  },
};
</script>

<style>
ion-icon {
  color: rgb(218, 132, 20);
}
</style>