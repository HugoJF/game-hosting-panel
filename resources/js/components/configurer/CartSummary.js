import React from 'react';

export default function ({parameters, state}) {
    const filteredParameters = Object
        .entries(state)
        .filter(([key]) => Object.keys(parameters).includes(key));

    function findInformation(key, value) {
        return Object
            .values(parameters[key].options)
            .filter(e => e.value === Number(value))
            [0];
    }

    return filteredParameters
        .map(([key, value]) => (
            <div key={key} className="flex justify-between">
                <div className="font-bold text-gray-700">
                    {parameters[key].name}
                </div>
                <p>
                    {findInformation(key, value).label}
                </p>
            </div>
        ))
}
