import React from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";

const options = {
    minutely: 'Minutely',
    hourly: 'Hourly',
    daily: 'Daily',
    weekly: 'Weekly',
    monthly: 'Monthly',
};

export default function PeriodSelector({selected, onSelect}) {
    function handleOnClick(optionId) {
        if (onSelect) onSelect({
            billing_period: selected === optionId ? null : optionId
        });
    }

    return <Section
        title="Billing period"
        subtitle=""
        icon="period"
    >
        <div className="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4">
            {
                Object
                    .entries(options)
                    .map(([optionId, text]) => (
                        <Button
                            onClick={handleOnClick.bind(this, optionId)}
                            selected={optionId === selected}
                        >
                            {text}
                        </Button>
                    ))
            }
        </div>
    </Section>
}
