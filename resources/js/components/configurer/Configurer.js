import React from 'react';
import Parameters from "./Parameters";
import Cart from "./Cart";

// TODO: lidar com o node_id da API

export default function ({csrf, route, parameters, onChange, state, cost}) {
    return <div>
        <form className="flex w-full" action={route} method="POST" onChange={onChange}>
            <input type="hidden" name="_token" value={csrf}/>
            <Parameters parameters={parameters}/>
            <Cart parameters={parameters} state={state} totalCost={cost}/>
        </form>
    </div>
}
