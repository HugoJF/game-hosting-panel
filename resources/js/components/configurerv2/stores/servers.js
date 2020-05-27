import get from 'lodash.get';

export const servers = {
    state: {
        creating: false,
        error: null,
    },
    reducers: {
        setLoading(state, loading = true) {
            return {...state, ...{loading}};
        },
        setError(state, error = null) {
            return {...state, ...{error}};
        }
    },
    effects: dispatch => ({
        async deploy(payload, root) {
            try {
                dispatch.servers.setLoading(true);
                let response = await axios.post(`/servers/${payload.server}/deploy`, payload.form); // TODO: wtf .form?
                return response.data;
            } catch (e) {
                let message = e.message;
                let responseMessage = get(e, 'response.data.message');

                dispatch.servers.setLoading(false);
                dispatch.servers.setError(responseMessage || message);

                return false;
            }
        },
        async create(payload, root) {
            try {
                dispatch.servers.setLoading(true);
                let response = await axios.post(`/servers`, payload);
                return response.data;
            } catch (e) {
                let message = e.message;
                let responseMessage = get(e, 'response.data.message');

                dispatch.servers.setLoading(false);
                dispatch.servers.setError(responseMessage || message);

                return false;
            }
        }
    })
};
