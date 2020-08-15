import React from 'react';
import Card from "../ui/Card";
import GenericSelector from "../resources/GenericSelector";
import useParameters from "../hooks/useParameters";
import useForm from "../hooks/useForm";

export default function ResourceSelection({onSelect}) {
    const parameters = useParameters();
    const form = useForm();

    return <Card
        title="Server resources"
        subtitle="Select the resource limits based on your demand."
        loading={parameters.loading}
        cols={2}
        gap={8}
    >
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {
                Object
                    .entries(parameters.parameters)
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
                        >
                            {(buttons) => <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                                {buttons}
                            </div>}
                        </GenericSelector>
                    ))
            }
        </div>
    </Card>
}
