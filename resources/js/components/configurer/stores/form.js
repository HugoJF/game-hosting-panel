import pickBy from 'lodash.pickby';

let source = axios.CancelToken.source();

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

    }),
};
