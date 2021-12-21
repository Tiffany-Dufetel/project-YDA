<!--
-- Header UI component
-->

<template>
  <div class="header">
    <h3>{{ title }}</h3>
    <h5>{{ subtitle }}</h5>
  </div>
</template>

<script>
export default {
  name: "Header",
  props: ["title", "subtitle"],
};
</script>

<style>
/* .header {
  background: #eeeeee;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 2px 0 0 10px #e78c15;
  width: 80vw;
  margin: 75px auto 0 auto;
} */
</style>
