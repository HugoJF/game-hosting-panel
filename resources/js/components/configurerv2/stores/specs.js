export const specs = {
    state: {
        loading: false,
        specs: {},
    },
    reducers: {
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.specs = payload;
            return state;
        },
    },
    effects: dispatch => ({
        async load({game, location}, root) {
            dispatch.specs.setLoading(true);
            let response = await axios.get(`/api/configurer/games/${game}/locations/${location}/specs`);
            dispatch.specs.set(response.data);
            dispatch.specs.setLoading(false);
        },
    }),
};
