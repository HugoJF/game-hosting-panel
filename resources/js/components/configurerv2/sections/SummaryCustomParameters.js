import React from 'react';
import get from "lodash.get";
import useSpecs from "../hooks/useSpecs";
import useForm from "../hooks/useForm";

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
        .entries(specs)
        .map(([specId, spec]) => (
            <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                <h4>{getSpecName(spec)}:</h4>
                {getSpecValue(spec, specId)}
            </div>
        ))
}
