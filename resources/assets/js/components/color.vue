<template>
<div class="color">
  <h3 class="color-title">{{ color.name }}</h3>
  <div class="color-swatch" v-bind:style="{backgroundColor: cssColor}"></div>
  <div class="color-descripion">
    <h4>Use Cases:</h4>
    <h4>Sass Variable Name:</h4>
    <h4>Color Definition:</h4>
  </div>
</div>
</template>

<script>
export default {
  props: ['color'],
  computed: {
    cssColor: function() {
      var type = this.color.definition.type;
      var value = this.color.definition.value;

      if ( type == "hex" ) {
        return "#" + value;
      } else if ( type == "rgb" ) {
        return "rgb(" + value + ")";
      } else if ( type == "rgba" ) {
        return "rgba(" + value + ")";
      } else if ( type == "hsl" ) {
        return "hsl(" + value + ")";
      } else if ( type == "hsla" ) {
        return "hsla(" + value + ")";
      }

      return "#000";

    }
  }
}
</script>

<style scoped lang="css">

.color {
  max-width: 200px;
}

.color-title {
  margin-bottom: .5em;
}

.color-swatch {
  width: 100%;
  height: 20px;
  border: 1px solid black;
  margin-bottom: .5em;
}

</style>
