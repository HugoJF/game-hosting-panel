import {init} from '@rematch/core'
import immer from '@rematch/immer'
import {cost} from './stores/cost';
import {form} from './stores/form';
import {games} from './stores/games';
import {locations} from './stores/locations';
import {specs} from './stores/specs';

const store = init({
    plugins: [immer()],
    models: {
        cost, form, games, locations, specs,
    },
});

export default store
