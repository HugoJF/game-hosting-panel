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
                source.cancel();
                source = axios.CancelToken.source();

                dispatch.form.update(payload);
                dispatch.cost.setLoading(true);
                let response = await axios.get('/api/cost/creation', {
                    params: root.config.config,
                    cancelToken: source.token,
                });
                dispatch.cost.setValue(response.data.cost);
                dispatch.cost.setLoading(false);
            } catch (e) {
                console.error(e);
            }
        },
    })
};
