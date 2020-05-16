import React from 'react';
import tailwind from "../tailwind";

const ButtonBody = tailwind.div(({selected}) => `
    trans px-4 py-2 ${selected ? 'text-blue-600' : 'text-black'} text-xl text-center
    font-bold border ${selected && 'border-blue-600 bg-blue-100'}
    rounded cursor-pointer ${selected && 'shadow'} select-none
`);

export default function Button({onClick, selected, children}) {
    return <ButtonBody $onClick={onClick} selected={selected}>
        {children}
    </ButtonBody>
}
