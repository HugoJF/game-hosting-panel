import React from 'react';
import get from 'lodash.get';
import useForm from "../hooks/useForm";
import summary from '../../icons/summary.svg';
import PeriodSelector from "./PeriodSelector";
import Card from "../ui/Card";
import Section from "../ui/Section";
import useGames from "../hooks/useGames";
import useLocations from "../hooks/useLocations";
import SummaryCustomParameters from "./SummaryCustomParameters";
import SummaryTotalCost from "./SummaryTotalCost";
import SummaryItem from "./SummaryItem";


const periods = {
    minutely: 'Minutely',
    hourly: 'Hourly',
    daily: 'Daily',
    weekly: 'Weekly',
    monthly: 'Monthly',
};

export default function Summary({onPeriodSelect}) {
    const form = useForm();
    const games = useGames();
    const locations = useLocations();

    function getGameName() {
        const id = get(form, 'game');
        return get(games, `games.${id}.name`)
    }

    function getLocationName() {
        const id = get(form, 'location');
        return get(locations, `locations.${id}.short`);
    }

    function getPeriod() {
        return get(periods, form.period);
    }

    return <Card
        title="Summary"
        subtitle="Details and cost for your new server"
        cols={2}
    >
        <Section
            title="Resumo"
            subtitle="Server specification"
            icon={summary}
            cols={1}
        >
            {/* Global parameter Game */}
            <SummaryItem name="Game" value={getGameName()}/>

            {/* Global parameter Location */}
            <SummaryItem name="Location" value={getLocationName()}/>

            {/* Custom parameters */}
            <SummaryCustomParameters/>

            {/* Global parameter Period */}
            <SummaryItem name="Period" value={getPeriod()}/>
        </Section>

        {/* Second column */}
        <div>
            <div className="mb-8">
                <PeriodSelector onSelect={onPeriodSelect}/>
            </div>
            <SummaryTotalCost />
        </div>
    </Card>
}
