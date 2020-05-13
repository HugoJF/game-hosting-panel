import {init} from '@rematch/core'
import * as models from './models'
import immerPlugin from '@rematch/immer'

const store = init({
    plugins: [immerPlugin()],
    models,
});

export default store
