import React from 'react';
import Card from "../ui/Card";
import GenericSelector from "../resources/GenericSelector";
import useSpecs from "../hooks/useSpecs";
import icons from '../icons';

export default function ResourceSelection({onSelect}) {
    const specs = useSpecs();

    return <Card
        title="Server resources"
        subtitle="Select the resource limits based on your demand."
        cols={2}
        gap={8}
    >
        {
            Object
                .entries(specs)
                .map(([id, spec]) => (
                <GenericSelector
                    key={id}
                    specId={id}
                    title={spec.name}
                    subtitle={spec.description}
                    icon={icons[spec.icon]}
                    onSelect={onSelect}
                    options={spec.options}
                />
            ))
        }
    </Card>
}
