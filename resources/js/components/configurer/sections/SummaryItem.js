import React from 'react';
import feather from 'feather-icons';
import tailwind from "../tailwind";

const Item = tailwind.div(() => `
    trans flex justify-between px-4 py-2 text-black text-center border rounded border-gray-300
`);

const RedText = tailwind.div(() => `
    text-red-600
`);

export default function SummaryItem({name, value}) {
    return <Item>
        <h4>{name}</h4>
        {
            value
                ?
                value
                :
                <RedText
                    title="This resources is required to compute server cost!"
                    data-toggle="tooltip"
                    data-placement="right"
                    dangerouslySetInnerHTML={{__html: feather.icons['alert-circle'].toSvg()}}
                />
        }
    </Item>
}
