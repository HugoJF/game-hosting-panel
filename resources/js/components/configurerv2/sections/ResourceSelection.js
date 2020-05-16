import React from 'react';
import Card from "../ui/Card";
import GenericSelector from "../resources/GenericSelector";
import useSpecs from "../hooks/useSpecs";
import icons from '../icons';
import useForm from "../hooks/useForm";

export default function ResourceSelection({onSelect}) {
    const specs = useSpecs();
    const form = useForm();

    return <Card
        title="Server resources"
        subtitle="Select the resource limits based on your demand."
        loading={specs.loading}
        cols={2}
        gap={8}
    >
        {
            Object
                .entries(specs.specs)
                .map(([id, spec]) => (
                <GenericSelector
                    key={id}
                    specId={id}
                    title={spec.name}
                    subtitle={spec.description}
                    icon={spec.icon}
                    selected={form[id]}
                    onSelect={onSelect}
                    options={spec.options}
                />
            ))
        }
    </Card>
}
