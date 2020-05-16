let source = axios.CancelToken.source();

export const form = {
    state: {},
    reducers: {
        // handle state changes with pure functions
        update(state, payload) {
            return {...state, ...payload};
        },
    },
    effects: dispatch => ({
        // handle state changes with impure functions.
        // use async/await for async actions
        async refresh(payload, root) {
            try {
                source.cancel();
                source = axios.CancelToken.source();
                dispatch.form.update(payload);
                dispatch.cost.setLoading(true);
                let response = await axios.get('/api/cost/creation', {
                    params: {
                        ...root.form,
                        ...payload,
                    },
                    cancelToken: source.token,
                });
                dispatch.cost.setValue(response.data.cost);
                dispatch.cost.setLoading(false);
            } catch (e) {
                console.error(e);
            }
        },
    }),
};
