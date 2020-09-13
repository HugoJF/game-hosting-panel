import React, {useEffect} from 'react';
import {useDispatch} from 'react-redux'
import useForm from "./hooks/useForm";
import Title from "./ui/Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/Summary";
import get from "lodash.get";

export default function DeployConfigurer({server, game, location}) {
    const dispatch = useDispatch();
    const form = useForm();

    useEffect(() => {
        dispatch.periods.getPeriods();
        dispatch.form.clear();
        dispatch.form.update({game, location});
        dispatch.parameters.fetchParameters({game, location, mode});
    }, []);

    function handleResourceSelect(resource) {
        dispatch.form.update(resource);
        dispatch.parameters.fetchParameters({
            mode: mode,
            ...form,
            ...resource,
        })
    }

    function handlePeriodSelect(period) {
        // TODO: handle period
        // dispatch.config.update(period);
        dispatch.cost.calculateCost();
    }

    async function onSubmit() {
        // TODO: update
        let response = await dispatch.servers.deploy({
            // config: config.config,
            server
        });

        let url = get(response, 'data.links.show');

        if (url) {
            window.location.href = url;
        } else {
            console.error(response);
            dispatch.servers.setError('Response from API is missing data.links.show');
        }
    }

    return <>
        <Title/>
        <GameSelection
            selectable={false}
            selected={form.game}
        />
        <LocationSelection
            selected={form.location}
        />
        <ResourceSelection
            onSelect={handleResourceSelect}
        />
        <Summary
            onPeriodSelect={handlePeriodSelect}
            onSubmit={onSubmit}
            submitText="Update"
        />
    </>
}
