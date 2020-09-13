import React from 'react';
import useCost from "../hooks/useCost";
import Section from "../ui/Section";
import tailwind from "../tailwind";
import Gate from "../ui/Gate";
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
    const form = useForm();
    const cost = useCost();

    const perPeriod = texts[form.billing_period];
    const _cost = cost.value / 100;
    const valid = !isNaN(_cost) && cost.value > 0;

    return <Section
        icon="cost"
        title="Total cost"
        subtitle="Server cost per billing period"
    >
        {/* Cost */}
        <Wrapper>
            <Gate ready={!cost.loading}>
                {/* Message */}
                {
                    !valid &&
                    <span className="text-gray-700 text-2xl font-normal">Please complete the form first.</span>
                }
                {/* Cost */}
                {
                    valid &&
                    <span>{formatter.format(_cost)}</span>
                }
                {/* Suffix */}
                {
                    valid &&
                    <Period>{perPeriod}</Period>
                }
            </Gate>
        </Wrapper>
    </Section>
}
