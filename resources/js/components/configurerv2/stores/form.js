export const form = {
    state: {},
    reducers: {
        // handle state changes with pure functions
        update2(state, payload) {
            return {...state, ...payload};
        },
    },
    effects: dispatch => ({
        // handle state changes with impure functions.
        // use async/await for async actions
        async update(payload, root) {
            console.log(payload);
            dispatch.form.update2(payload);
            dispatch.cost.setLoading(true);
            await new Promise(resolve => setTimeout(resolve, 2000));
            let response = await axios.get('/api/cost/creation', {
                params: {
                    ...root.specs,
                }
            });
            dispatch.cost.setLoading(false);
            dispatch.cost.setValue(response.data.cost);
        },
    }),
};
