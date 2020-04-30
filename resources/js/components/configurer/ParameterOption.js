import React from 'react';

export default function ({id, parameter, option: {label, value}}) {
    return <>
        <input className="hidden" id={id} name={parameter} type="radio" value={value}/>
        <label htmlFor={id}
               className="trans flex items-center justify-center w-1/2 py-4 mx-2
                            text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                            checked:bg-gray-900 checked:text-gray-100 checked:shadow-md
                            checked:font-medium checked:cursor-default
                            hover:bg-white hover:text-gray-900 hover:shadow"
        >
            {label}
        </label>
    </>
}
