import React, {useState} from 'react';
import Section from "../ui/Section";
import Button from "../ui/Button";

export default function GenericSelector({title, subtitle, icon, onSelect, options, cols = 4}) {
    const [selected, setSelected] = useState(false);

    function handleOnClick(id) {
        let n = selected === id ? null : id;
        setSelected(n);
        if(onSelect) onSelect(n);
    }

    return <Section
        title={title}
        subtitle={subtitle}
        icon={icon}
        cols={cols}
    >
        {Object.entries(options).map(([id, text]) => (
            <Button
                onClick={handleOnClick.bind(this, id)}
                selected={id === selected}
            >
                {text}
            </Button>
        ))}
    </Section>
}
