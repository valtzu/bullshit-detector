export const blackboxApiEndpoint = state => state.blackboxApiEndpoint;

export const bullshits = state => state.bullshits.filter(bullshit => !state.results[bullshit].words).map(bullshit => ({
    phrase: bullshit,
}));

export const nonBullshits = state => state.bullshits.filter(bullshit => state.results[bullshit].words).map(bullshit => ({
    phrase: state.results[bullshit].phrase,
    words: state.results[bullshit].words,
}));

export const loaderPromise = state => Promise.all(state.loaderPromises);