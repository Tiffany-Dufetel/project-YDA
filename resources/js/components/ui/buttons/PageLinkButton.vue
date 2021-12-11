<!--
-- Back comment UI component
-->

<template>
  <div>
    <!-- Link button -->
    <router-link :to="{ name: ['routeName'] }">
      <button>{{ buttonText }}</button>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "Link",
  props: ["routeName", "buttonText"],
};
</script>

<style>
</style>