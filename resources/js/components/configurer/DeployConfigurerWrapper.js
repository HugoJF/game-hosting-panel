import React from 'react';
import {Provider} from 'react-redux'
import store from './store'
import DeployConfigurer from "./DeployConfigurer";

export default function DeployConfigurerWrapper(data) {
    return <Provider store={store}>
        <DeployConfigurer {...data}/>
    </Provider>
}
