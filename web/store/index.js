import Vue from 'vue';
import Vuex from 'vuex';
import * as getters from './getters';
import * as actions from './actions';
import mutations from './mutations';

Vue.use(Vuex);

const state = {
    blackboxApiEndpoint: process.env.VUE_APP_API_ENDPOINT,
    bullshits: [],
    results: {},
};

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
});