export const fetchBullshits = async ({ commit, getters, dispatch }) => {
    const response = await fetch(`${getters.blackboxApiEndpoint}/bullshits`);
    const bullshits = await response.json();
    commit('storeBullshits', bullshits);
    await Promise.all(bullshits.map(bullshit => dispatch('inspect', bullshit)));
};

export const inspect = async ({ commit, getters }, payload) => {
    const response = await fetch(`${getters.blackboxApiEndpoint}/inspect?message=${encodeURIComponent(payload)}`);
    commit('storeResult', await response.json());
};
