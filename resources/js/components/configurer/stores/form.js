import pickBy from 'lodash.pickby';

export const form = {
    state: {},
    reducers: {
        // handle state changes with pure functions
        update(state, payload) {
            return {...state, ...payload};
        },
        set(state, payload) {
            return payload;
        },
        clear(state, payload = []) {
            return pickBy(state, (v, k) => payload.includes(k))
        }
    },
    effects: dispatch => ({
        async current(payload, root) {
            dispatch.parameters.setLoading(true);

            try {
                // TODO: maybe update this to /servers/{server-hash} so billing_period can be updated
                let response = await axios.get(`/api/configurer/${payload}/current-form`);
                dispatch.form.update(response.data);
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.parameters.setLoading(false);
            }
        }
    }),
};
