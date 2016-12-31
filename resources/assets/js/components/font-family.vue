<template>
<div class="font-family">
  <h2 class="font-family-name">{{ fontFamily.name }}</h2>
  <div class="font-family-style" v-for="style in fontFamily.styles">
    <link v-bind:href="fontFamily.liveLink" rel="stylesheet" type="text/css">
    <h3 class="font-family-style-name">{{ style.name }}</h3>
    <div class="branding-font-example" v-bind:style="{ fontFamily: fontFamily.cssName, fontWeight: style.weight, fontStyle: style.style}">
      ABCDEFGHIJKLMNOPQRSTUVWXYZ<br />
      abcdefghijklmnopqrstuvwxyz<br />
      1234567890(,.;:?!$&amp;*)
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['fontFamily'],
}
</script>

<style>
  .branding-font-example {
    font-size: 24px;
    background: #eee;
    padding: 1rem;
  }
</style>
