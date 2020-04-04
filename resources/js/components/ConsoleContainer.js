import React from "react";

export default function ConsoleContainer({children}) {
    return (
        <div className="relative flex flex-col w-full font-mono text-xs text-gray-300 bg-gray-900 rounded-lg overflow-hidden">
            {children}
        </div>
    )
};