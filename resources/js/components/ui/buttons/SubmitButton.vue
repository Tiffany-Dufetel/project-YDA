<!--
-- Submit button UI component
-->

<template>
  <div>
    <!-- Submit button -->
    <button class="btn-show">
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
