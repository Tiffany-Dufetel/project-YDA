<!--
-- Back comment UI component
-->

<template>
  <div class="backbutton">
    <!-- Back button -->
    <a @click="back">
        <img src="../../../assets/backbutton.png"><p>retour</p>
    </a>
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
  color: #da8414;
}
.backbutton a{
    padding: 10px 0;
    display: flex;
    cursor: pointer;
}
.backbutton p {
    text-transform: uppercase;
    font-size: 19px;
    letter-spacing: 2px;
    padding-left: 10px;
    padding-bottom: 2px;
}

.backbutton img {
    width: 25px;
    height: 25px;
}
</style>
