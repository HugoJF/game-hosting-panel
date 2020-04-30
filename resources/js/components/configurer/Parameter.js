import React from 'react';
import ParameterOption from "./ParameterOption";
import ParameterTitle from "./ParameterTitle";
import ParameterDetails from "./ParameterDetails";

export default function ({parameterKey, parameter: {name, cost, description, options}}) {
    return <div className="mb-8">
        {/* Header */}
        <div className="flex items-stretch bg-green-600 overflow-hidden rounded-t-lg">
            <ParameterTitle title={name}/>

            <ParameterDetails cost={cost} description={description}/>
        </div>

        {/* Parameter options */}
        <div className="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
            {
                Object.entries(options).map(([optionKey, option]) => (
                    <ParameterOption
                        key={optionKey}
                        id={optionKey}
                        parameter={parameterKey}
                        option={option}
                    />
                ))
            }
        </div>
    </div>
}
