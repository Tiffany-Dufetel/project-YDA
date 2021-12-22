<!--
-- Header UI component
-->

<template>
  <div class="header">
    <h2>{{ title }}</h2>
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
.header {
  padding:4vh ;
  width: 80vw;
  margin: 20px auto 0 auto;
  text-align: center;
  background-color: white;
  -webkit-box-shadow: 1px 1px 15px 1px #f3f3f3;
  box-shadow: 1px 1px 15px 1px #f3f3f3;

}

.header h2{
    text-transform: uppercase;
    color: #e78c15;
    letter-spacing: 3px;
}
</style>
