export const parameters = {
    state: {
        loading: false,
        parameters: {},
    },
    reducers: {
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.parameters = payload;
            return state;
        },
    },
    effects: dispatch => ({
        async fetchParameters({game, location, ...rest}, root) {
            dispatch.parameters.setLoading(true);
            try {
                let response = await axios.get(`/api/configurer/games/${game}/locations/${location}/parameters`, {
                    params: rest,
                });

                dispatch.parameters.set(response.data);
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.parameters.setLoading(false);
            }
        },
    }),
};
