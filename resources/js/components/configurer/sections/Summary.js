import React from 'react';
import get from 'lodash.get';
import useForm from "../hooks/useForm";
import PeriodSelector from "./PeriodSelector";
import Card from "../ui/Card";
import Section from "../ui/Section";
import useGames from "../hooks/useGames";
import useLocations from "../hooks/useLocations";
import SummaryTotalCost from "./SummaryTotalCost";
import SummaryItem from "./SummaryItem";
import SummarySubmitButton from "./SummarySubmitButton";
import useConfig from "../hooks/useConfig";
import NameSelector from "./NameSelector";

const periods = {
    minutely: 'Minutely',
    hourly: 'Hourly',
    daily: 'Daily',
    weekly: 'Weekly',
    monthly: 'Monthly',
};

export default function Summary({onNameChange, onPeriodSelect, onSubmit, onSubmitted}) {
    const config = useConfig();
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
        return get(periods, config.config.billing_period);
    }

    function getCpu() {
        let cpu = get(config, 'config.cpu', '0');
        return `${cpu} marks`;
    }

    function getMemory() {
        let memory = get(config, 'config.memory', '0');
        return `${memory} MB`;
    }

    function getDisk() {
        let disk = get(config, 'config.disk', '0');
        return `${disk} MB`;
    }

    function getDatabases() {
        let databases = get(config, 'config.databases', '0');
        return `${databases}`;
    }

    return <Card
        title="Summary"
        subtitle="Details and cost for your new server"
        cols={2}
    >
        <Section
            title="Resumo"
            subtitle="Server specification"
            icon="summary"
            cols={1}
        >
            {/* Global parameter Game */}
            <SummaryItem name="Game" value={getGameName()}/>

            {/* Global parameter Location */}
            <SummaryItem name="Location" value={getLocationName()}/>

            {/* Server spec */}
            <SummaryItem name="CPU" value={getCpu()}/>
            <SummaryItem name="Memory" value={getMemory()}/>
            <SummaryItem name="Disk" value={getDisk()}/>
            <SummaryItem name="Databases" value={getDatabases()}/>

            {/* Global parameter Period */}
            <SummaryItem name="Period" value={getPeriod()}/>
        </Section>

        {/* Second column */}
        <div>
            {
                onNameChange && <div className="mb-8">
                    <NameSelector value={config.config.name} onNameChange={onNameChange}/>
                </div>
            }


            {/* Period select */}
            <div className="mb-8">
                <PeriodSelector selected={config.config.billing_period} onSelect={onPeriodSelect}/>
            </div>

            {/* Total cost */}
            <SummaryTotalCost/>

            {/* Submit button */}
            <SummarySubmitButton onSubmit={onSubmit} onSubmitted={onSubmitted}/>
        </div>
    </Card>
}
