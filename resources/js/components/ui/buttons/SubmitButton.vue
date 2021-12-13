<!--
-- Submit button UI component
-->

<template>
  <div>
    <!-- Submit button -->
    <button class="btn text-dark bg-light btn-block border border-dark">
      {{ name }}
    </button>
  </div>
</template>

<script>
export default {
  name: "SubmitButton",
  props: ["name"],
};
</script>

<style>
</style>