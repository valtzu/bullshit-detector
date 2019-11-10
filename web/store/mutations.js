import Vue from 'vue';

export default {
    storeBullshits: (state, payload) => {
        payload.forEach((payload) => { Vue.set(state.results, payload, {}); });
        state.bullshits = payload;
    },
    storeResult: (state, { message, results }) => {
        state.results[message] = results;
    },
}