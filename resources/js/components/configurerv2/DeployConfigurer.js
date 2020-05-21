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
        dispatch.form.refresh({game, location});
        dispatch.specs.load({game, location});
    }, []);

    function handleResourceSelect(resource) {
        dispatch.form.refresh(resource);
    }

    function handlePeriodSelect(period) {
        dispatch.form.refresh(period);
    }

    async function onSubmit() {
        let response = await dispatch.servers.deploy({server, form});

        if (response === false) return;

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
        />
    </>
}
