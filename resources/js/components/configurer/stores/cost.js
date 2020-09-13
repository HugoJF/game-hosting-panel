let source = axios.CancelToken.source();

export const cost = {
    state: {
        loading: false,
        value: 0,
    },
    reducers: {
        setLoading(state, loading = true) {
            return {...state, ...{loading}};
        },
        setValue(state, value) {
            return {...state, ...{value}};
        }
    },
    effects: dispatch => ({
        async calculateCost(payload, root) {
            try {
                dispatch.cost.setLoading(true);

                source.cancel();
                source = axios.CancelToken.source();

                dispatch.form.update(payload);

                let response = await axios.get('/api/cost/creation', {
                    params: root.form,
                    cancelToken: source.token,
                });

                dispatch.cost.setValue(response.data.cost);
            } catch (e) {
                console.error(e);
            } finally {
                dispatch.cost.setLoading(false);
            }
        },
    })
};
