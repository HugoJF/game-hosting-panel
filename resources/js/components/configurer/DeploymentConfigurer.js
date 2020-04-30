import React, {useState} from 'react';
import Configurer from "./Configurer";
import parameters from './p'

export default function ({csrf, route, server}) {
    const [state, setState] = useState({});
    const [cost, setCost] = useState(0);

    function handleOnChange(e) {
        const newState = {
            server,
            ...state,
            ...{[e.target.name]: e.target.value}
        };
        console.log(newState);
        setState(newState);
        axios.get('/api/cost/deployment', {params: newState})
            .then(handleCostUpdate);
    }

    function handleCostUpdate(response) {
        setCost(response.data.cost)
    }

    return <Configurer
        csrf={csrf}
        route={route}
        parameters={parameters}
        onChange={handleOnChange}
        state={state}
        cost={cost}
    />
}
