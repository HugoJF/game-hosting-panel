import React from 'react';
import ScaleLoader from "react-spinners/ScaleLoader";

export default function Card({title, subtitle, children, loading = false, gap = 4, cols = 4}) {
    return <div className="mb-8 bg-white rounded-lg overflow-hidden">
        <div className="px-8 py-4 border-b bg-gray-100">
            <h2>{title}</h2>
            <p className="text-gray-700">{subtitle}</p>
        </div>
        <div className="relative">
            {
                loading && <>
                    <div className="absolute top-0 left-0 right-0 bottom-0
                        text-3xl z-40"
                    />
                    <div className="flex items-center justify-center
                        absolute top-0 left-0 right-0 bottom-0
                        text-3xl font-semibold z-50"
                    >
                        <ScaleLoader
                            color="#2d3748"
                            width={6}
                            height={50}
                            margin={5}
                        />
                    </div>
                </>
            }

            <div
                className={`trans grid grid-cols-${cols} gap-${gap} p-8`}
                style={{minHeight: '8rem', filter: loading ? 'grayscale(100%) blur(4px)' : 'grayscale(0%) blur(0)'}}
            >
                {children}
            </div>
        </div>
    </div>
}
