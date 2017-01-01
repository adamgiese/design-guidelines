<template>
<div class="typography-pattern">
  <div class="branding-guideline">
    <h3 class="typography-name" v-bind:style="css">{{ pattern.name }}</h3>
    <p class="typography-uses">{{ pattern.uses }}</p>
    <link v-bind:href="pattern.googleLink" rel="stylesheet" type="text/css">
    <pre class="typography-code"><code class="branding-rule--css" v-for="rule in pattern.properties">{{rule}}</code></pre>
  </div>
</div>
</template>

<script>
export default {
  props: ['pattern'],
  computed: {
    css: function() {
      var css = '';
      var rules = this.pattern.properties;
      for (var i = 0; i < rules.length; i++) {
        css = css + rules[i];
      }
      css = css.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); });
      console.log(css);
      return css;
    }
  }
}
</script>

<style scoped>
code {
  display: block;
}
.typography-pattern {
  margin-bottom: 1rem;
}
.typography-name {
  margin-bottom: 0;
}
.typography-uses {
  margin-top: 0;
  font-style: italic;
  font-size: .9em;
}
</style>
