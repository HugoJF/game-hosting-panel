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
    effects: {},
};

export const specs = {
    state: {}, // initial state
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
            dispatch.specs.update2(payload);
            dispatch.cost.setLoading(true);
            await new Promise(resolve => setTimeout(resolve, 2000));
            let response = await axios.get('/api/cost/creation', {
                params: {
                    ...root.specs,
                    ...{location: 1}
                }
            });
            dispatch.cost.setLoading(false);
            dispatch.cost.setValue(response.data.cost);
        },
    }),
};

export const games = {
    state: {games: {}, loading: true}, // initial state
    reducers: {
        // handle state changes with pure functions
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.games = payload;
            return state;
        },
    },
    effects: dispatch => ({
        // handle state changes with impure functions.
        // use async/await for async actions
        async load(payload, root) {
            dispatch.games.setLoading(true);
            await new Promise(resolve => setTimeout(resolve, 2000));
            dispatch.games.set({
                minecraft: {
                    name: 'Minecraft',
                    image: 'https://i.redd.it/uhdomasbp1p31.png'
                },
                csgo: {
                    name: 'Counter Strike: Global Offensive',
                    image: 'https://i.imgur.com/rAwX8Af.png'
                },
                cod4: {
                    name: 'Call of Duty 4: Modern Warfare',
                    image: 'https://i.imgur.com/ADfCGqM.png'
                },
                css: {
                    name: 'Counter Strike: Source',
                    image: 'https://i.imgur.com/aSpVNeW.png'
                },
                cod2: {
                    name: 'Call of Duty: 2',
                    image: 'https://i.imgur.com/ORlkG0P.png'
                },
            });
            dispatch.games.setLoading(false);
        },
    }),
};
export const locations = {
    state: {locations: {}, loading: true}, // initial state
    reducers: {
        // handle state changes with pure functions
        setLoading(state, payload) {
            state.loading = payload;
            return state;
        },
        set(state, payload) {
            state.locations = payload;
            return state;
        },
    },
    effects: dispatch => ({
        // handle state changes with impure functions.
        // use async/await for async actions
        async load(payload, root) {
            dispatch.locations.setLoading(true);
            await new Promise(resolve => setTimeout(resolve, 2000));
            dispatch.locations.set({
                brazil: {
                    name: 'Brazil',
                    enabled: true,
                },
                us: {
                    name: 'United States',
                    enabled: false,
                },
                canada: {
                    name: 'Canada',
                    enabled: true,
                },
            });
            dispatch.locations.setLoading(false);
        },
    }),
};
