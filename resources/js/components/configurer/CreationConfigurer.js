import React, {useState} from 'react';
import Configurer from "./Configurer";
import parameters from './p'

export default function ({csrf, route, location}) {
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

    return <Configurer
        csrf={csrf}
        route={route}
        parameters={parameters}
        onChange={handleOnChange}
        state={state}
        cost={cost}
    />
}
