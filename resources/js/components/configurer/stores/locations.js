export const locations = {
    state: {locations: {}, loading: false}, // initial state
    reducers: {
        // handle state changes with pure functions
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        makeUnavailable(state, payload) {
            let entries = Object.entries(state.locations);

            let up = {};

            for (let [k, v] of entries) {
                up[k] = {
                    ...v,
                    available: false,
                }
            }
            state.locations = up;

            return state;
        },
        set(state, payload) {
            state.locations = payload;
            return state;
        },
    },
    effects: dispatch => ({
        async preLoad(payload, root) {
            dispatch.locations.setLoading(true);

            try {
                let response = await axios.get(`/api/configurer/locations`);
                dispatch.locations.set(response.data);
                dispatch.locations.makeUnavailable();
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.locations.setLoading(false);
            }
        },

        async load(payload, root) {
            dispatch.locations.setLoading(true);
            try {
                let response = await axios.get(`/api/configurer/games/${payload}/locations`);
                dispatch.locations.set(response.data);
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.locations.setLoading(false);
            }
        },
    }),
};
