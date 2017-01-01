<template>
<div class="color">
  <h3 class="color-title">{{ color.name }}</h3>
  <code class="color-code">{{ cssColor }}</code>
  <div class="color-swatch" v-bind:style="{backgroundColor: cssColor}"></div>
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
