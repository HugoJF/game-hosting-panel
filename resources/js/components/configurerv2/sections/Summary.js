import React from 'react';
import get from 'lodash.get';
import useCost from "../hooks/useCost";
import useForm from "../hooks/useForm";
import useSpecs from "../hooks/useSpecs";
import summary from '../../icons/summary.svg';
import costIcon from '../../icons/cost.svg';
import PeriodSelector from "./PeriodSelector";
import Card from "../ui/Card";
import Section from "../ui/Section";
import useGames from "../hooks/useGames";
import useLocations from "../hooks/useLocations";
import SummaryCustomParameters from "./SummaryCustomParameters";
import SummaryTotalCost from "./SummaryTotalCost";


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
        return get(games, `games.${id}.name`, '')
    }

    function getLocationName() {
        const id = get(form, 'location');
        return get(locations, `locations.${id}.short`, '');
    }

    function getPeriod() {
        return get(periods, form.period, '');
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
            <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                <h4>Game:</h4>
                {getGameName()}
            </div>

            {/* Global parameter Location */}
            <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                <h4>Location:</h4>
                {getLocationName()}
            </div>

            {/* Global parameter Period */}
            <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                <h4>Period:</h4>
                {getPeriod()}
            </div>

            {/* Custom parameters */}
            <SummaryCustomParameters/>
        </Section>

        <div>
            <div className="mb-8">
                <PeriodSelector onSelect={onPeriodSelect}/>
            </div>
            <SummaryTotalCost />
        </div>
    </Card>
}
