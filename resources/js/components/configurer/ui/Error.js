import React from 'react';
import Feather from "./Feather";
import tailwind from "../tailwind";


const ErrorWrapper = tailwind.div(() => `
    px-5 py-4 flex bg-red-200 text-red-600 border border-red-600 rounded shadow
`);

const Title = tailwind.div(() => `
    flex-grow font-semibold
`);

const Description = tailwind.div(() => `
    mt-2 ml-2 text-xs font-thin font-mono
`);

export default function Error({title, children}) {
    const _title = title || children || 'Error';

    return <ErrorWrapper>
        <Feather className="pr-4" icon="alert-circle"/>
        <div>
            <Title>{_title}</Title>
            {
                title &&
                <Description>{children}</Description>
            }
        </div>
    </ErrorWrapper>
}
