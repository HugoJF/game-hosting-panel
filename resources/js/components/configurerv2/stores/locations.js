export const locations = {
    state: {locations: {}, loading: false}, // initial state
    reducers: {
        // handle state changes with pure functions
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.locations = payload;
            return state;
        },
    },
    effects: dispatch => ({
        async preLoad(payload, root) {
            console.log('payload', payload);
            dispatch.locations.setLoading(true);
            let response = await axios.get(`/api/configurer/locations`);
            dispatch.locations.set(response.data);
            dispatch.locations.setLoading(false);
        },
        async load(payload, root) {
            console.log('payload', payload);
            dispatch.locations.setLoading(true);
            let response = await axios.get(`/api/configurer/games/${payload}/locations`);
            dispatch.locations.set(response.data);
            dispatch.locations.setLoading(false);
        },
    }),
};
