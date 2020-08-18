import React from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";
import usePeriods from "../hooks/usePeriods";

export default function PeriodSelector({selected, onSelect}) {
    const periods = usePeriods();

    function handleOnClick(optionId) {
        if (onSelect) onSelect({
            billing_period: selected === optionId ? null : optionId
        });
    }

    return <Section
        title="Billing period"
        subtitle="How often the server will be billed"
        icon="period"
    >
        <div className="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-4">
            { periods &&
                Object
                    .entries(periods.periods)
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
