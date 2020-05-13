import React from 'react';
import feather from "feather-icons";
import icons from "../../icons";

export default function Location({id, location, selected, onClick}) {
    const {short, long, flag, available} = location;

    return <div
        onClick={available ? onClick.bind(this, id) : undefined}
        className={`trans relative flex flex-row items-center
            px-6 py-4 border ${selected ? 'border-blue-600 bg-blue-100 shadow' : ''}
            rounded ${available ? 'cursor-pointer' : 'opacity-50 cursor-not-allowed'}
        `}
        style={{filter: available ? '' : 'grayscale(100%)'}}
    >
        {/* Selection check */}
        <div
            className={`trans m-2 absolute text-white top-0 right-0 bg-blue-600 ${selected ? 'opacity-100' : 'opacity-0'} rounded-full shadow`}
            dangerouslySetInnerHTML={{__html: feather.icons.check.toSvg()}}
        />

        {/* Location flag */}
        <div className="w-16 h-16">
            <img alt={`${short} | ${long}`} src={icons[flag]}/>
        </div>

        {/* Location name and description */}
        <div className={`ml-4 flex-grow ${selected ? 'text-blue-700' : ''}`}>
            <p className="text-xl font-bold">{short}</p>
            <p className="text-sm font-light tracking-tight">{long}</p>
        </div>
    </div>
}
