import React from 'react';
import get from "lodash.get";
import useSpecs from "../hooks/useSpecs";
import useForm from "../hooks/useForm";
import SummaryItem from "./SummaryItem";

export default function SummaryCustomParameters() {
    const specs = useSpecs();
    const form = useForm();

    function getSpecName(spec) {
        return get(spec, 'name', '')
    }

    function getSpecValue(spec, specId) {
        return get(spec, `options.${get(form, specId)}`, '')
    }

    return Object
        .entries(specs.specs)
        .map(([specId, spec]) => (
            <SummaryItem
                name={getSpecName(spec)}
                value={getSpecValue(spec, specId)}
            />
        ))
}
