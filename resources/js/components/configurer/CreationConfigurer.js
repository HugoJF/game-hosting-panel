import React, {useEffect} from 'react';
import {useDispatch} from 'react-redux'
import Title from "./ui/Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/Summary";
import useForm from "./hooks/useForm";
import get from "lodash.get";

export default function CreationConfigurer() {
    const dispatch = useDispatch();
    const form = useForm();

    useEffect(() => {
        dispatch.periods.getPeriods();
    }, []);

    function handleGameSelect(game) {
        dispatch.form.update({game});
        dispatch.form.clear(['game', 'billing_period']);
        if (game) {
            dispatch.locations.load(game);
        } else {
            dispatch.locations.makeUnavailable();
        }
    }

    function handleLocationSelect(location) {
        dispatch.form.update({location});
        dispatch.form.clear(['game', 'location', 'billing_period']);
        dispatch.parameters.fetchParameters({
            game: form.game,
            location
        });
    }

    function handleResourceSelect(resource) {
        dispatch.form.update(resource);
        dispatch.parameters.fetchParameters({
            ...form,
            ...resource,
        });
        dispatch.cost.calculateCreationCost();
    }

    function handlePeriodSelect(period) {
        dispatch.form.update({billing_period: period});
        dispatch.cost.calculateCreationCost();
    }

    function handleNameChange(event) {
        dispatch.form.update({name: event.target.value});
    }

    async function onSubmit() {
        let server = await dispatch.servers.create(form);

        if (server === false) return;

        let url = get(server, 'data.links.show');

        if (url) {
            window.location.href = url;
        } else {
            console.error(server);
            dispatch.servers.setError('Response from API is missing data.links.show');
        }
    }

    return <>
        <Title/>
        <GameSelection
            selected={form.game}
            onSelect={handleGameSelect}
        />
        <LocationSelection
            selected={form.location}
            onSelect={handleLocationSelect}
        />
        <ResourceSelection
            onSelect={handleResourceSelect}
        />
        <Summary
            onNameChange={handleNameChange}
            onPeriodSelect={handlePeriodSelect}
            onSubmit={onSubmit}
            submitText="Create"
        />
    </>
}
