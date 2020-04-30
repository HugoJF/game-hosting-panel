import React from 'react';

export default function ({cost, description}) {
    return <div className="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white">
        {/* Cost */}
        <div>
            <small className="font-light text-xl text-green-100">R$ </small>
            <span className="font-medium">{cost}</span>
        </div>

        {/* Description */}
        <div className="font-normal text-green-200 tracking-tight text-sm">
            {description}
        </div>
    </div>
}
