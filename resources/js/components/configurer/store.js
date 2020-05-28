import {init} from '@rematch/core'
import immer from '@rematch/immer'
import {cost} from './stores/cost';
import {form} from './stores/form';
import {games} from './stores/games';
import {locations} from './stores/locations';
import {parameters} from './stores/parameters';
import {servers} from './stores/servers';
import {config} from "./stores/config";

const store = init({
    plugins: [immer()],
    models: {
        cost, form, games, locations, parameters, servers, config,
    },
});

export default store
