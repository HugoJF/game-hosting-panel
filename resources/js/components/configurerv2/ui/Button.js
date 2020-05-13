import React from 'react';

export default function Button({onClick, selected, children}) {
    return <div
        onClick={onClick}
        className={`trans px-4 py-2 ${selected ? 'text-blue-600' : 'text-black'} text-xl text-center
        font-bold border ${selected && 'border-blue-600 bg-blue-100'}
        rounded cursor-pointer ${selected && 'shadow'} select-none`}
    >
        {children}
    </div>
}
