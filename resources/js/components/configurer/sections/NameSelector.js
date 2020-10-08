import React from 'react';
import Section from "../ui/Section";

export default function NameSelector({value, onNameChange}) {
    return <Section
        title="Name"
        subtitle="A user friendly name for your server"
        icon="tag"
    >
        <input
            className="w-full px-4 py-2 text-xl font-normal border border-gray-300 rounded"
            placeholder="Insert server name here..."
            maxLength={191}
            value={value}
            onChange={onNameChange}
        />
    </Section>
}
