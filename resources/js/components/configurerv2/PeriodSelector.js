import React from 'react';
import period from './../icons/period.svg';
import GenericSelector from "./GenericSelector";

const options = {
    minutely: 'Minutely',
    hourly: 'Hourly',
    daily: 'Daily',
    weekly: 'Weekly',
    monthly: 'Monthly',
};

export default function PeriodSelector({onSelect}) {
    return <GenericSelector
        title="Billing period"
        subtitle=""
        icon={period}
        onSelect={onSelect}
        cols={3}
        options={options}
    />;
}
