import React, {useRef} from 'react';

export default function ({cost}) {
    const formatter = useRef(new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}));

    return <div className="flex justify-between text-2xl">
        <p className="font-bold text-gray-700">
            TOTAL
        </p>
        <p className="font-bold">{formatter.current.format(cost / 100)}</p>
    </div>
}
