import React from 'react';
import Title from "./Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/partials/Summary";
import {useDispatch} from "react-redux";

export default function Configurer({handleChange, cost}) {
    const dispatch = useDispatch();

    function handleGameSelect(game) {
        dispatch.form.update({game});
        console.log(game);
        if (game) dispatch.locations.load(game);
    }

    function handleLocationSelect(location) {
        dispatch.form.update({location})
    }

    function handleResourceSelect(resource) {
        dispatch.form.update(resource);
    }

    function handlePeriodSelect(period) {
        dispatch.form.update(period);
    }

    return <>
        <Title/>
        <GameSelection onSelect={handleGameSelect}/>
        <LocationSelection onSelect={handleLocationSelect}/>
        <ResourceSelection onSelect={handleResourceSelect}/>
        <Summary onPeriodSelect={handlePeriodSelect}/>
    </>
}
