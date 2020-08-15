import React from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";

export default function GenericSelector({specId, title, subtitle, icon, selected, onSelect, options, children}) {
    function handleOnClick(optionId) {
        if (onSelect) onSelect({
            [specId]: selected === optionId ? null : optionId
        });
    }

    const buttons = Object
        .entries(options)
        .map(([optionId, text]) => (
            <Button
                onClick={handleOnClick.bind(this, optionId)}
                selected={optionId === selected}
            >
                {text}
            </Button>
        ));

    return <Section
        title={title}
        subtitle={subtitle}
        icon={icon}
    >
        {children ? children(buttons) : buttons}
    </Section>
}
