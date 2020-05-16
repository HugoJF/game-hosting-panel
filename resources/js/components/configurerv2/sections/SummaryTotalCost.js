import React from 'react';
import Section from "../ui/Section";
import useCost from "../hooks/useCost";
import Loader from "../ui/Loader";
import SummaryCreateButton from "./SummaryCreateButton";
import tailwind from "../tailwind";

const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

const Period = tailwind.div(() => `
    ml-1 text-2xl text-gray-700 font-light tracking-tight
`);

const Wrapper = tailwind.div(() => `
    flex mb-6 justify-center items-baseline text-3xl
`);

export default function SummaryTotalCost() {
    const cost = useCost();

    return <Section
        icon="cost"
        title="Total cost"
        cols={1}
    >
        {/* Cost */}
        <Wrapper>
            {
                cost.loading
                    ? <Loader/>
                    : <>
                        <span>{formatter.format(cost.value / 100)}</span>
                        <Period>por dia</Period>
                    </>
            }
        </Wrapper>

        {/* Button */}
        <SummaryCreateButton/>
    </Section>
}
