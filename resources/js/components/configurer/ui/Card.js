import React from 'react';
import Loader from "./Loader";
import tailwind from "../tailwind";

const CardWrapper = tailwind.div(() => `
    mb-8 bg-white rounded-lg overflow-hidden border border-gray-300
`);

const CardHeader = tailwind.div(() => `
    flex items-center px-6 py-2 border-b border-gray-300 bg-gray-100
`);

const Status = tailwind.div(({color = 'red'}) => `
    transition-colors duration-300 mr-3 h-4 w-4 bg-${color}-500 border-4 border-${color}-300 rounded-full
`);

const CardTitle = tailwind.div(() => `
    text-xl lg:text-3xl text-base
`);

const HeaderDivider = tailwind.div(() => `
    self-stretch my-2 mx-4 border-r border-gray-300
`);

const CardSubtitle = tailwind.div(() => `
    text-gray-700
`);

const CardBody = tailwind.div(() => `
    relative grid grid-2
`);

const CardLoadingOverlay = tailwind.div(() => `
    flex items-center justify-center
    absolute top-0 left-0 right-0 bottom-0 z-50
`);

const ContentWrapper = tailwind.div(() => `
    trans min-h-32 p-8
`);

export default function Card({title, subtitle, children, loading = false, status = undefined}) {

    function getContentWrapperStyle() {
        return {
            filter: loading ? 'grayscale(100%) blur(4px)' : 'grayscale(0%) blur(0)'
        };
    }

    return <CardWrapper>
        <CardHeader>
            {status && <Status color={status}/>}
            <CardTitle>{title}</CardTitle>
            <HeaderDivider/>
            <CardSubtitle>{subtitle}</CardSubtitle>
        </CardHeader>

        <CardBody>
            {
                loading && <CardLoadingOverlay>
                    <Loader/>
                </CardLoadingOverlay>
            }

            <ContentWrapper
                $style={getContentWrapperStyle()}
            >
                {children}
            </ContentWrapper>
        </CardBody>
    </CardWrapper>
}
