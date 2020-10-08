export const games = {
    state: {games: {}, loading: true}, // initial state
    reducers: {
        // handle state changes with pure functions
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.games = payload;
            return state;
        },
    },
    effects: dispatch => ({
        // handle state changes with impure functions.
        // use async/await for async actions
        async load(payload, root) {
            dispatch.games.setLoading(true);

            try {
                let response = await axios.get('/api/configurer/games');
                dispatch.games.set(response.data);
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.games.setLoading(false);
            }
        },
    }),
};
