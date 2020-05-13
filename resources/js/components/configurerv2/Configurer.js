import React from 'react';
import Title from "./Title";
import GameSelection from "./GameSelection";
import LocationSelection from "./LocationSelection";
import ResourceSelection from "./ResourceSelection";
import Summary from "./Summary";
import {useDispatch} from "react-redux";

export default function Configurer({handleChange, cost}) {
    const dispatch = useDispatch();

    function handleGameSelect(game) {
        dispatch.specs.update({game});
        if (game) dispatch.locations.load();
    }

    function handleLocationSelect(location) {
        dispatch.specs.update({location})
    }

    function handleResourceSelect(resource) {
        dispatch.specs.update({...resource});
    }

    function handlePeriodSelect(period) {
        dispatch.specs.update({period});
    }

    return <>
        <Title/>
        <GameSelection onSelect={handleGameSelect}/>
        <LocationSelection onSelect={handleLocationSelect}/>
        <ResourceSelection onSelect={handleResourceSelect}/>
        <Summary onPeriodSelect={handlePeriodSelect}/>
    </>
}
