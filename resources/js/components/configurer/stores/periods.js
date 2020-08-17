export const periods = {
    state: {
        periods: {},
    },
    reducers: {
        set(state, payload) {
            state.periods = payload;
            return state;
        },
    },
    effects: dispatch => ({
        async getPeriods(state, root) {
            try {
                let response = await axios.get(`/api/configurer/billing-periods`);
                dispatch.periods.set(response.data);
            } catch (e) {
                console.error(e);
            }
        },
    }),
};
