import React from 'react';
import PeriodSelector from "./PeriodSelector";
import Card from "../ui/Card";
import Section from "../ui/Section";
import useForm from "../hooks/useForm";
import useGames from "../hooks/useGames";
import useLocations from "../hooks/useLocations";
import usePeriods from "../hooks/usePeriods";
import SummaryTotalCost from "./SummaryTotalCost";
import SummaryItem from "./SummaryItem";
import SummarySubmitButton from "./SummarySubmitButton";
import NameSelector from "./NameSelector";
import get from 'lodash.get';
import SummaryCustomParameters from "./SummaryCustomParameters";

export default function Summary({onNameChange, onPeriodSelect, onSubmit, submitText}) {
    const form = useForm();
    const games = useGames();
    const locations = useLocations();
    const periods = usePeriods();

    function getGameName() {
        const id = get(form, 'game');
        return get(games, `games.${id}.name`)
    }

    function getLocationName() {
        const id = get(form, 'location');
        return get(locations, `locations.${id}.short`);
    }

    function getPeriod() {
        return get(periods.periods, form.billing_period);
    }

    const nameSet = form.name;
    const periodSet = form.billing_period;

    return <Card
        title="Summary"
        subtitle="Details and cost for your new server"
        status={nameSet && periodSet ? 'green' : 'red'}
    >

        <div className="grid grid-cols-1 xl:grid-cols-2 gap-4">
            <Section
                title="Resumo"
                subtitle="Server specification"
                icon="summary"
            >
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4">
                    {/* Global parameter Game */}
                    <SummaryItem name="Game" value={getGameName()}/>

                    {/* Global parameter Location */}
                    <SummaryItem name="Location" value={getLocationName()}/>

                    {/* Global parameter Period */}
                    <SummaryItem name="Period" value={getPeriod()}/>

                    {/* Game specific parameters */}
                    <SummaryCustomParameters/>
                </div>
            </Section>

            {/* Second column */}
            <div>
                {
                    onNameChange && <div className="mb-8">
                        <NameSelector value={form.name} onNameChange={onNameChange}/>
                    </div>
                }


                {/* Period select */}
                <div className="mb-8">
                    <PeriodSelector selected={form.billing_period} onSelect={onPeriodSelect}/>
                </div>

                {/* Total cost */}
                <SummaryTotalCost/>

                {/* Submit button */}
                <SummarySubmitButton
                    text={submitText}
                    onSubmit={onSubmit}
                />
            </div>
        </div>
    </Card>
}
