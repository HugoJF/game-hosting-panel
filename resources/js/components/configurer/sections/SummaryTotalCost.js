import React from 'react';
import useConfig from "../hooks/useConfig";
import useCost from "../hooks/useCost";
import Section from "../ui/Section";
import Loader from "../ui/Loader";
import tailwind from "../tailwind";

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
    const config = useConfig();

    const perPeriod = texts[config.config.billing_period];
    const _cost = cost.value / 100;
    const valid = !isNaN(_cost) && cost.value > 0;

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
                        {/* Message */}
                        {
                            !valid &&
                            <span className="text-gray-700 text-2xl font-normal">Please complete the form first.</span>
                        }
                        {/* Cost */}
                        {
                            valid &&
                            <span>
                                {formatter.format(_cost)}
                            </span>
                        }
                        {/* Suffix */}
                        {
                            valid &&
                            <Period>{perPeriod}</Period>
                        }
                    </>
            }
        </Wrapper>
    </Section>
}
