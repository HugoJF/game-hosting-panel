import React from 'react';
import Loader from "./Loader";
import tailwind from "../tailwind";

const CardWrapper = tailwind.div(() => `
    mb-8 bg-white rounded-lg overflow-hidden
`);

const CardHeader = tailwind.div(() => `
    px-8 py-4 border-b bg-gray-100
`);

const CardSubtitle = tailwind.div(() => `
    text-gray-700
`);

const CardBody = tailwind.div(() => `
    relative
`);

const CardLoadingOverlay = tailwind.div(() => `
    flex items-center justify-center
    absolute top-0 left-0 right-0 bottom-0 z-50
`);

const ContentWrapper = tailwind.div(({cols, gap}) => `
    trans grid grid-cols-${cols} gap-${gap} min-h-32 p-8
`);

export default function Card({title, subtitle, children, loading = false, gap = 4, cols = 4}) {

    function getContentWrapperStyle() {
        return {
            filter: loading ? 'grayscale(100%) blur(4px)' : 'grayscale(0%) blur(0)'
        };
    }

    return <CardWrapper>
        <CardHeader>
            <h2>{title}</h2>
            <CardSubtitle>{subtitle}</CardSubtitle>
        </CardHeader>

        <CardBody>
            {
                loading && <CardLoadingOverlay>
                    <Loader/>
                </CardLoadingOverlay>
            }

            <ContentWrapper
                cols={cols}
                gap={gap}
                style={getContentWrapperStyle()}
            >
                {children}
            </ContentWrapper>
        </CardBody>
    </CardWrapper>
}
