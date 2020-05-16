import React from 'react';
import Title from "./ui/Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/Summary";
import {useDispatch} from "react-redux";
import useForm from "./hooks/useForm";

export default function Configurer({handleChange, cost}) {
    const dispatch = useDispatch();
    const form = useForm();

    function handleGameSelect(game) {
        dispatch.form.update({game});
        if (game) {
            dispatch.locations.load(game);
        }
    }

    function handleLocationSelect(location) {
        dispatch.form.update({location});
        dispatch.specs.load({
            game: form.game,
            location
        });
    }

    function handleResourceSelect(resource) {
        dispatch.form.refresh(resource);
    }

    function handlePeriodSelect(period) {
        dispatch.form.refresh(period);
    }

    return <>
        <Title/>
        <GameSelection onSelect={handleGameSelect}/>
        <LocationSelection onSelect={handleLocationSelect}/>
        <ResourceSelection onSelect={handleResourceSelect}/>
        <Summary onPeriodSelect={handlePeriodSelect}/>
    </>
}
