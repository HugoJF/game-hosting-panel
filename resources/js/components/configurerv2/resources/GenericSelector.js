import React from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";

export default function GenericSelector({specId, title, subtitle, icon, selected, onSelect, options, cols = 4}) {
    function handleOnClick(optionId) {
        if (onSelect) onSelect({
            [specId]: selected === optionId ? null : optionId
        });
    }

    return <Section
        title={title}
        subtitle={subtitle}
        icon={icon}
        cols={cols}
    >
        {
            Object
                .entries(options)
                .map(([optionId, text]) => (
                    <Button
                        onClick={handleOnClick.bind(this, optionId)}
                        selected={optionId === selected}
                    >
                        {text}
                    </Button>
                ))
        }
    </Section>
}
