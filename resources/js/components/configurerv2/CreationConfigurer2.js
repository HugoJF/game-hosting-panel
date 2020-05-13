import React, {useState} from 'react';
import Configurer from "./Configurer";
import {Provider} from 'react-redux'
import store from './store'

export default function CreationConfigurer2() {
    const [state, setState] = useState({});
    const [cost, setCost] = useState(0);

    function handleOnChange(e) {
        const newState = {
            location,
            ...state,
            ...{[e.target.name]: e.target.value}
        };
        setState(newState);
        axios.get('/api/cost/creation', {params: newState})
            .then(handleCostUpdate);
    }

    function handleCostUpdate(response) {
        setCost(response.data.cost)
    }

    return <Provider store={store}>
        <Configurer
            cost={cost}
            onChange={handleOnChange}
        />
    </Provider>
}
