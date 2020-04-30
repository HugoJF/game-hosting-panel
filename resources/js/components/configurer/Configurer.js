import React, {useState} from 'react';
import Parameters from "./Parameters";
import Summary from "./Summary";

const parameters = {
    cpu: {
        name: 'CPU',
        cost: 50,
        unit: '%',
        description: 'por 100% CPU',
        options: {
            'cpu-25': {
                label: '25%',
                value: 25,
            },
            'cpu-50': {
                label: '50%',
                value: 50,
            },
            'cpu-75': {
                label: '75%',
                value: 75,
            },
            'cpu-100': {
                label: '100%',
                value: 100,
            },
        },
    },
    memory: {
        'name': 'RAM',
        'cost': 20,
        'description': 'por GB',
        'options': {
            'ram-1': {
                'label': '1GB',
                'value': 1000,
            },
            'ram-2': {
                'label': '2GB',
                'value': 2000,
            },
            'ram-3': {
                'label': '3GB',
                'value': 3000,
            },
            'ram-4': {
                'label': '4GB',
                'value': 4000,
            },
            'ram-5': {
                'label': '5GB',
                'value': 5000,
            },
        },
    },
    disk: {
        'name': 'SSD',
        'cost': 5,
        'description': 'por 10GB',
        'options': {
            'disk-10000': {
                'label': '10GB',
                'value': 10000,
            },
            'disk-20000': {
                'label': '20GB',
                'value': 20000,
            },
            'disk-30000': {
                'label': '30GB',
                'value': 30000,
            },
            'disk-40000': {
                'label': '40GB',
                'value': 40000,
            },
            'disk-50000': {
                'label': '50GB',
                'value': 50000,
            },
        },
    },
    databases: {
        'name': 'Databases',
        'cost': 5,
        'description': 'por database',
        'options': {
            'db-1': {
                'label': '1',
                'value': 1,
            },
            'db-2': {
                'label': '2',
                'value': 2,
            },
            'db-3': {
                'label': '3',
                'value': 3,
            },
        },
    }
};

export default function ({location}) {
    const [state, setState] = useState({});
    const [cost, setCost] = useState(null);

    function handleOnChange(e) {
        const newState = {
            ...state,
            ...{[e.target.name]: e.target.value}
        };
        console.log(newState);
        setState(newState);
        axios.get(`/api/nodes/location/${location}/cost`, {params: newState})
            .then(handleCostUpdate());
    }

    function handleCostUpdate(cost) {
        setCost(cost)
    }

    return <div className="flex justify-center">
        <form className="flex w-full" action="" onChange={handleOnChange}>
            <Parameters parameters={parameters}/>
            <Summary parameters={parameters} state={state} totalCost={cost} />
        </form>
    </div>
}
