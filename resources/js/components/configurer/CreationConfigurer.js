import React, {useState} from 'react';
import {useDispatch} from 'react-redux'
import Title from "./ui/Title";
import GameSelection from "./sections/GameSelection";
import LocationSelection from "./sections/LocationSelection";
import ResourceSelection from "./sections/ResourceSelection";
import Summary from "./sections/Summary";
import useForm from "./hooks/useForm";
import get from "lodash.get";
import ModeSelection from "./sections/ModeSelection";
import useConfig from "./hooks/useConfig";

export default function CreationConfigurer() {
    const dispatch = useDispatch();
    const form = useForm();
    const config = useConfig();
    const [mode, setMode] = useState('simple');

    function handleGameSelect(game) {
        dispatch.form.update({game});
        dispatch.form.clear(['game', 'billing_period']);
        dispatch.config.clear();
        dispatch.config.update({game});
        if (game) {
            dispatch.locations.load(game);
        } else {
            dispatch.locations.makeUnavailable();
        }
    }

    function handleLocationSelect(location) {
        dispatch.form.update({location});
        dispatch.form.clear(['game', 'location', 'billing_period']);
        dispatch.config.clear(['game']);
        dispatch.config.update({location});
        dispatch.parameters.fetchParameters({
            game: form.game,
            mode,
            location
        });
    }

    function handleModeSelect(_mode) {
        setMode(_mode);
        dispatch.form.clear(['game', 'location', 'billing_period']);
        dispatch.parameters.fetchParameters({
            game: form.game,
            mode: _mode,
            location: form.location,
        });
    }

    async function handleResourceSelect(resource) {
        dispatch.form.update(resource);
        if (mode === 'simple') {
            await Promise.all([
                dispatch.config.computeResources(),
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

    /*
     * remover loading do config (?)
     * cancelar requests da translations
     * cleanar tudo quando mudar de modo
     */

    function handlePeriodSelect(period) {
        dispatch.config.update(period);
        dispatch.cost.calculateCost();
    }

    function handleNameChange(event) {
        dispatch.config.update({
            name: event.target.value,
        })
    }

    async function onSubmit() {
        let server = await dispatch.servers.create(config.config);

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
        <ModeSelection
            selected={mode}
            onSelect={handleModeSelect}
        />
        <ResourceSelection
            onSelect={handleResourceSelect}
        />
        <Summary
            onNameChange={handleNameChange}
            onPeriodSelect={handlePeriodSelect}
            onSubmit={onSubmit}
        />
    </>
}
