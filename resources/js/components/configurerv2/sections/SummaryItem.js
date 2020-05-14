import React from 'react';
import feather from 'feather-icons';

export default function SummaryItem({name, value}) {
    return <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
        <h4>{name}</h4>
        {
            value
                ?
                value
                :
                <div
                    title="This resources is required to compute server cost!"
                    data-toggle="tooltip"
                    data-placement="right"
                    className="text-red-600"
                    dangerouslySetInnerHTML={{__html: feather.icons['alert-circle'].toSvg()}}
                />
        }
    </div>
}
