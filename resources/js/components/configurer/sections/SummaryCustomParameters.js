import React from 'react';
import get from "lodash.get";
import SummaryItem from "./SummaryItem";
import useParameters from "../hooks/useParameters";
import useForm from "../hooks/useForm";

export default function SummaryCustomParameters() {
    const parameters = useParameters();
    const form = useForm();

    function getSpecName(spec) {
        return get(spec, 'name', '')
    }

    function getSpecValue(spec, specId) {
        return get(spec, `options.${get(form, specId)}`, '')
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
