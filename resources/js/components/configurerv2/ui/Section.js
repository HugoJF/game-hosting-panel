import React from 'react';
import tailwind from "../tailwind";

const Wrapper = tailwind.div(() => `
    flex
`);

const Icon = tailwind.div(() => `
    w-16 h-16 mr-6
`);

const Body = tailwind.div(() => `
    flex-grow
`);

const Header = tailwind.div(() => `
    mb-3 flex items-baseline
`);

const Subtitle = tailwind.div(() => `
    ml-1 text-sm text-gray-600 font-light
`);

const Options = tailwind.div(({cols}) => `
    grid grid-cols-${cols} gap-4
`);

export default function Section({icon, title, subtitle, cols = 4, children}) {
    return <Wrapper>
        <Icon>
            <img src={icon} alt=""/>
        </Icon>

        <Body>
            <Header>
                <h3>{title}</h3>
                <Subtitle>{subtitle}</Subtitle>
            </Header>

            <Options cols={cols}>
                {children}
            </Options>
        </Body>
    </Wrapper>
}
