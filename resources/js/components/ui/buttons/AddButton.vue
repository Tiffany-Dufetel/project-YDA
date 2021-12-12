<!--
-- Add button UI component
-->

<template>
  <div>
    <!-- Add button -->
    <button class="btn text-white bg-dark btn-block">
      {{ name }}
    </button>
  </div>
</template>

<script>
export default {
  name: "AddButton",
  props: ["name"],
};
</script>

<style>
</style>