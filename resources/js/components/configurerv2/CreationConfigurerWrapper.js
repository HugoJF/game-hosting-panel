import React from 'react';
import {Provider} from 'react-redux'
import store from './store'
import CreationConfigurer from "./CreationConfigurer";

export default function CreationConfigurerWrapper() {
    return <Provider store={store}>
        <CreationConfigurer/>
    </Provider>
}
