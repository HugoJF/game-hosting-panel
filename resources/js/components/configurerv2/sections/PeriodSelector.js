import React from 'react';
import period from '../../icons/period.svg';
import GenericSelector from "../resources/GenericSelector";

const options = {
    minutely: 'Minutely',
    hourly: 'Hourly',
    daily: 'Daily',
    weekly: 'Weekly',
    monthly: 'Monthly',
};

export default function PeriodSelector({selected, onSelect}) {
    return <GenericSelector
        specId="period"
        title="Billing period"
        subtitle=""
        icon={period}
        selected={selected}
        onSelect={onSelect}
        cols={3}
        options={options}
    />;
}
