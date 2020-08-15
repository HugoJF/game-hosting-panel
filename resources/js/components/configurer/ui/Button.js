import React from 'react';
import tailwind from "../tailwind";

const ButtonBody = tailwind.div(({selected}) => `
    trans flex px-4 py-2 ${selected ? 'text-blue-600' : 'text-black'} items-center justify-center text-xl text-center
    font-medium border ${selected && 'border-blue-600 bg-blue-100'}
    rounded cursor-pointer ${selected && 'shadow'} select-none
    ${!selected && 'hover:shadow'}
`);

export default function Button({onClick, selected, children}) {
    return <ButtonBody $onClick={onClick} selected={selected}>
        {children}
    </ButtonBody>
}
