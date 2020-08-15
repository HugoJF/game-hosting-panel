import React from 'react';
import tailwind from "../tailwind";
import icons from '../icons';

const Wrapper = tailwind.div(() => `
    flex
`);

const IconWrapper = tailwind.div(() => `
    w-16 h-16 mr-6 text-gray-800 fill-current
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

export default function Section({icon, title, subtitle, children}) {
    const Icon = icons[icon];

    return <Wrapper>
        <IconWrapper>
            <Icon/>
        </IconWrapper>

        <Body>
            <Header>
                <h3>{title}</h3>
                <Subtitle>{subtitle}</Subtitle>
            </Header>

            <div>
                {children}
            </div>
        </Body>
    </Wrapper>
}
