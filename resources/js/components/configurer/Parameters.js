import React from 'react';
import Parameter from "./Parameter";


export default function ({parameters}) {
    return <div className="p-4 w-2/3">
        {
            Object.entries(parameters).map(([parameterKey, parameter]) => (
                <Parameter
                    key={parameterKey}
                    parameterKey={parameterKey}
                    parameter={parameter}
                />
            ))
        }
    </div>
}
