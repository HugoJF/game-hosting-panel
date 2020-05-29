import React from 'react';
import GenericSelector from "../resources/GenericSelector";
import Button from "../ui/Button";
import Section from "../ui/Section";

export default function NameSelector({value, onNameChange}) {
    return <Section
        title="Name"
        subtitle="A user friendly name for your server"
        icon="tag"
        cols={1}
    >
        <input
            className="px-4 py-2 text-xl border rounded"
            placeholder="Insert server name here..."
            maxLength={191}
            value={value}
            onChange={onNameChange}
        />
    </Section>
}
