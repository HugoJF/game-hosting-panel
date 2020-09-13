import get from 'lodash.get';

async function attempt(dispatch, action) {
    try {
        return await action();
    } catch (e) {
        const message = e.message;
        const responseMessage = get(e, 'response.data.message');

        dispatch.servers.setLoading(false);
        dispatch.servers.setError(responseMessage || message);

        return false;
    }
}

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
            dispatch.servers.setLoading(true);
            dispatch.servers.setError();

            return await attempt(dispatch, async () => {
                let response = await axios.patch(`/servers/${payload.server}`, payload.form);

                return response.data;
            });
        },
        async create(payload, root) {
            dispatch.servers.setLoading(true);

            return await attempt(dispatch, async () => {
                let response = await axios.post(`/servers`, payload);

                return response.data;
            });
        }
    })
};
