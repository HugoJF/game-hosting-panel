import React from 'react';

export default function Section({icon, title, subtitle, cols = 4, children}) {
    return <div className="flex">
        {/* Icon */}
        <div className="w-16 h-16 mr-6">
            <img src={icon} alt=""/>
        </div>

        {/* Body */}
        <div className="flex-grow">
            {/* Header */}
            <div className="mb-3 flex items-baseline">
                <h3>{title}</h3>
                <small className="ml-1 text-sm text-gray-600 font-light">{subtitle}</small>
            </div>

            {/* Options */}
            <div className={`grid grid-cols-${cols} gap-4`}>
                {children}
            </div>
        </div>
    </div>
}
