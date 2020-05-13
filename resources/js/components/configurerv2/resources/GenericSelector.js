import React, {useState} from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";

export default function GenericSelector({specId, title, subtitle, icon, onSelect, options, cols = 4}) {
    const [selected, setSelected] = useState(false);

    function handleOnClick(optionId) {
        let n = selected === optionId ? null : optionId;
        setSelected(n);
        if (onSelect) onSelect({[specId]: n});
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
