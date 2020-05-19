import React from 'react';
import Section from "../ui/Section";
import useCost from "../hooks/useCost";
import Loader from "../ui/Loader";
import SummaryCreateButton from "./SummaryCreateButton";
import tailwind from "../tailwind";
import useForm from "../hooks/useForm";

const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

const Period = tailwind.div(() => `
    ml-1 text-2xl text-gray-700 font-light tracking-tight
`);

const Wrapper = tailwind.div(() => `
    flex mb-6 justify-center items-baseline text-3xl
`);

const texts = {
    minutely: 'per minute',
    hourly: 'per hour',
    daily: 'per day',
    weekly: 'per week',
    monthly: 'per month',
};

export default function SummaryTotalCost() {
    const cost = useCost();
    const form = useForm();

    const perPeriod = texts[form.billing_period];

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
                        <span>{isNaN(cost.value) ? '-' : formatter.format(value)}</span>
                        {
                            perPeriod && <Period>{perPeriod}</Period>
                        }
                    </>
            }
        </Wrapper>

        {/* Button */}
        <SummaryCreateButton/>
    </Section>
}
