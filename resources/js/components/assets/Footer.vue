<!--
-- Footer asset component
-->

<template>
  <footer>
    <p><b>&copy; Your Daily Assistant</b></p>
    <p><b>&copy; assistantes@your-daily-assistant.fr</b></p>
    <p><b>&copy; 06 43 88 43 82</b></p>
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
</style>
