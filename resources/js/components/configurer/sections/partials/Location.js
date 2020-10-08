import React from 'react';
import feather from "feather-icons";
import flags from "../../flags";
import tailwind from "../../tailwind";

const Wrapper = tailwind.div(({available, selected}) => `
    transition-all duration-150 relative flex flex-row items-center select-none
    px-6 py-4 border ${selected ? 'border-blue-600 bg-blue-100 shadow' : ''}
    rounded ${available ? 'cursor-pointer' : 'cursor-not-allowed'} ${!available && !selected ? 'opacity-50' : ''}
    ${available || selected && 'hover:shadow'}
`);

const SelectionCheck = tailwind.div(({selected}) => `
    transition-all duration-150 m-2 absolute text-white top-0 right-0
    bg-blue-600 ${selected ? 'opacity-100' : 'opacity-0'}
    rounded-full shadow
`);

const Flag = tailwind.div(() => `
    w-16 h-16 flex-shrink-0
`);

const Body = tailwind.div(() => `
    ml-4
`);

const Info = tailwind.div(({selected}) => `
    flex flex-col lg:flex-row lg:items-baseline flex-wrap flex-grow ${selected ? 'text-blue-700' : ''}
`);

const Long = tailwind.div(() => `
    lg:mr-2 text-xl font-medium
`);

const Short = tailwind.div(() => `
    text-sm font-normal tracking-tight
`);

const Description = tailwind.div(() => `
    text-sm font-light
`);

export default function Location({id, location, selected, onClick}) {
    const {short, long, description, flag, available} = location;

    function getWrapperOnClick() {
        return available ? onClick.bind(this, id) : undefined;
    }

    function getWrapperStyle() {
        return {
            filter: available || selected ? '' : 'grayscale(100%)'
        };
    }

    return <Wrapper
        onClick={getWrapperOnClick()}
        style={getWrapperStyle()}
        $selected={selected}
        $available={available}
    >
        <SelectionCheck
            $selected={selected}
            dangerouslySetInnerHTML={{__html: feather.icons.check.toSvg()}}
        />

        <Flag>
            <img alt={`${long} | ${short}`} src={flags[flag]}/>
        </Flag>

        <Body>
            <Info>
                <Long>{long}</Long>
                <Short>{short}</Short>
            </Info>

            <Description>
                {description}
            </Description>
        </Body>
    </Wrapper>
}
