<template>
  <div id="app">
    <section id="bullshits">
      <h3>Bullshits ({{ this.bullshits.length }} pcs) <Loader v-if="this.isLoading" /></h3>
      <Phrase v-for="(value, i) in this.bullshits" :key="`bullshit-${i}`" :phrase="value.phrase"/>
    </section>
    <section id="non-bullshits">
      <h3>Non-bullshits ({{ this.nonBullshits.length }} pcs) <Loader v-if="this.isLoading" /></h3>
      <Phrase v-for="(value, i) in this.nonBullshits" :key="`bullshit-${i}`" :words="value.words"/>
    </section>
  </div>
</template>

<script>
import Phrase from './components/Phrase.vue'
import Loader from './components/Loader.vue'
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'app',
  components: {
    Phrase,
    Loader,
  },
  data: () => ({isLoading: false}),
    computed: {...mapGetters(['bullshits', 'nonBullshits', 'loaderPromise'])},
    methods: {...mapActions(['fetchBullshits'])},
    async mounted() {
      this.isLoading = true;
      await this.fetchBullshits();
      this.isLoading = false;
    }
}
</script>

<style lang="scss">
#app {
  display: flex;

  > * {
    flex: 1 1 50%;
  }
}
</style>
