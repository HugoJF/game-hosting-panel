import React from 'react';

export default function ({name}) {
    return <div className="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
        {name}
    </div>
}
