<!--
-- Footer asset component
-->

<template>
  <footer>
    <p><b>&copy; Your Daily Assistant</b></p>
    <p class="contact">assistantes@your-daily-assistant.fr</p>
    <p class="contact">06 43 88 43 82</p>
  </footer>
</template>

<script>
export default {
  name: "footer",
};
</script>

<style scoped>
footer {
  position: fixed;
  display: flex;
  justify-content: space-around;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #000000;
  color: #dbd8d5;
  text-align: right;
}
.contact {
  font-size: 12px;
}
</style>
