let source = axios.CancelToken.source();

const CREATION = 'creation';
const DEPLOYMENT = 'deployment';

async function calculateCost(dispatch, type, params) {
    try {
        source.cancel();
        source = axios.CancelToken.source();

        dispatch.cost.setLoading(true);

        let response = await axios.get(`/api/cost/${type}`, {
            params: params,
            cancelToken: source.token,
        });

        dispatch.cost.setValue(response.data.cost);
    } catch (e) {
        console.error(e);
    } finally {
        dispatch.cost.setLoading(false);
    }
}

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
        async calculateCreationCost(payload, root) {
            await calculateCost(dispatch, CREATION, root.form);
        },
        async calculateDeploymentCost(payload, root) {
            await calculateCost(dispatch, DEPLOYMENT, root.form);
        },
    })
};
