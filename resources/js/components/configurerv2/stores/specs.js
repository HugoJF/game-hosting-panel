export const specs = {
    state: {
        game: {
            custom: false,
            name: 'Game',
        },
        location: {
            custom: false,
            name: 'Location',
        },
        period: {
            custom: false,
            name: 'Period',
            options: {
                minutely: 'Minutely',
                hourly: 'Hourly',
                daily: 'Daily',
                weekly: 'Weekly',
                monthly: 'Monthly',
            }
        },
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
