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
    state: {
        cpu: {
            name: 'CPU',
            icon: 'cpu',
            description: 'Maximum core usage',
            options: {
                25: '25%',
                50: '50%',
                75: '75%',
                100: '100%',
            },
        },
        memory: {
            name: 'Memory',
            icon: 'memory',
            description: 'Maximum memory usage',
            options: {
                1000: '1 GB',
                2000: '2 GB',
                3000: '3 GB',
                4000: '4 GB',
                5000: '5 GB',
            },
        },
        disk: {
            name: 'Disk',
            icon: 'disk',
            description: 'Maximum disk usage',
            options: {
                5000: '5 GB',
                10000: '10 GB',
                20000: '20 GB',
                30000: '30 GB',
                40000: '40 GB',
                50000: '50 GB',
            },
        },
        databases: {
            name: 'Databases',
            icon: 'databases',
            description: 'Maximum database tables',
            options: {
                0: '0',
                1: '1',
                2: '2',
                3: '3',
            }
        }
    },
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
            let response = await axios.get('/api/cost/creation', {
                params: {
                    ...root.specs,
                    ...{location: 1}
                }
            });
        },
    }),
};
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
            let response = await axios.get('/api/configurer/games');
            dispatch.games.set(response.data);
            // dispatch.games.set({
            //     minecraft: {
            //         name: 'Minecraft',
            //         image: 'https://i.redd.it/uhdomasbp1p31.png'
            //     },
            //     csgo: {
            //         name: 'Counter Strike: Global Offensive',
            //         image: 'https://i.imgur.com/rAwX8Af.png'
            //     },
            //     cod4: {
            //         name: 'Call of Duty 4: Modern Warfare',
            //         image: 'https://i.imgur.com/ADfCGqM.png'
            //     },
            //     css: {
            //         name: 'Counter Strike: Source',
            //         image: 'https://i.imgur.com/aSpVNeW.png'
            //     },
            //     cod2: {
            //         name: 'Call of Duty: 2',
            //         image: 'https://i.imgur.com/ORlkG0P.png'
            //     },
            // });
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
                    short: 'Brazil',
                    long: 'Maxihost - MH1',
                    enabled: true,
                },
                us: {
                    short: 'United States',
                    long: 'Level3',
                    enabled: false,
                },
                canada: {
                    short: 'Canada',
                    long: 'OVH',
                    enabled: true,
                },
            });
            dispatch.locations.setLoading(false);
        },
    }),
};
