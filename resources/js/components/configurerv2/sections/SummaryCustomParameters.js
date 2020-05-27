import React from 'react';
import get from "lodash.get";
import useSpecs from "../hooks/useSpecs";
import useForm from "../hooks/useForm";
import SummaryItem from "./SummaryItem";
import useConfig from "../hooks/useConfig";

export default function SummaryCustomParameters() {
    const specs = useSpecs();
    const config = useConfig();

    function getSpecName(spec) {
        return get(spec, 'name', '')
    }

    function getSpecValue(spec, specId) {
        return get(spec, `options.${get(config, specId)}`, '')
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
