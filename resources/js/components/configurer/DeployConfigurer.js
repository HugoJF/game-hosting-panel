import React, {useEffect, useState} from 'react';
import {useDispatch} from 'react-redux'
import useForm from "./hooks/useForm";
import Title from "./ui/Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/Summary";
import get from "lodash.get";
import ModeSelection from "./sections/ModeSelection";
import useConfig from "./hooks/useConfig";

export default function DeployConfigurer({server, game, location}) {
    const dispatch = useDispatch();
    const config = useConfig();
    const form = useForm();
    const [mode, setMode] = useState('simple');

    useEffect(() => {
        dispatch.form.clear();
        dispatch.form.update({game, location});
        dispatch.config.clear();
        dispatch.config.update({game, location});
        dispatch.parameters.fetchParameters({game, location, mode});
    }, []);

    function handleModeSelect(mode) {
        setMode(mode);
        dispatch.form.clear(['game', 'location', 'billing_period']);
        dispatch.parameters.fetchParameters({
            game: form.game,
            mode: mode,
            location: form.location,
        });
    }

    async function handleResourceSelect(resource) {
        dispatch.form.update(resource);
        if (mode === 'simple') {
            await Promise.all([
                dispatch.config.computeResources({
                    game: config.config.game,
                    location: config.config.location,
                }),
                dispatch.parameters.fetchParameters({
                    mode: mode,
                    ...form,
                    ...resource,
                })
            ]);
        } else {
            dispatch.config.update(resource);
            dispatch.cost.calculateCost();
        }
    }

    function handlePeriodSelect(period) {
        dispatch.config.update(period);
        dispatch.cost.calculateCost();
    }

    async function onSubmit() {
        let response = await dispatch.servers.deploy({
            config: config.config,
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
        <ModeSelection
            selected={mode}
            onSelect={handleModeSelect}
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
