import React from 'react';
import get from "lodash.get";
import useParameters from "../hooks/useParameters";
import useForm from "../hooks/useForm";
import SummaryItem from "./SummaryItem";
import useConfig from "../hooks/useConfig";

export default function SummaryCustomParameters() {
    const parameters = useParameters();
    const config = useConfig();

    function getSpecName(spec) {
        return get(spec, 'name', '')
    }

    function getSpecValue(spec, specId) {
        return get(spec, `options.${get(config, specId)}`, '')
    }

    return Object
        .entries(parameters.parameters)
        .map(([specId, spec]) => (
            <SummaryItem
                name={getSpecName(spec)}
                value={getSpecValue(spec, specId)}
            />
        ))
}
