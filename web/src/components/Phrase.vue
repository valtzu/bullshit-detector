<template>
  <p v-if="words && words.length > 0">
    <span v-for="(word, i) in words" :key="`word-${i}`" :title="word.tags.join(', ')">{{ word.word }}</span>
  </p>
  <p v-else-if="phrase">
    {{ phrase }}
  </p>
</template>

<script>

export default {
  name: 'Phrase',
  props: {
    phrase: String,
    words: Array,
  }
}
</script>

<style scoped>
  span + span:before {
    content: ' ';
  }
</style>