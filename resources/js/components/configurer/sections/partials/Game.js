import React from 'react';
import tailwind from "../../tailwind";

const Card = tailwind.div(({selected}) => `
    transition-all duration-150 relative rounded ${selected ? 'shadow-md' : 'hover:shadow-md'} overflow-hidden
`);

const Image = tailwind.img(({selectable}) => `
    z-0 transition-all duration-150 ${selectable ? 'cursor-pointer' : 'cursor-no    t-allowed'} shadow-lg
`);

export default function Game({id, game, selectable = true, selected, onClick}) {
    const scaled = {transform: 'scale(1.05)'};
    const muted = {transform: '', filter: 'blur(1px) grayscale(100%) brightness(25%)'};

    const {name, cover} = game;

    const nothingSelected = selected === null;

    function getContainerStyle() {
        return selected ? scaled : {};
    }

    function getImageStyle() {
        return (nothingSelected || selected) ? {} : muted;
    }

    return <Card
        $selected={selected}
        onClick={onClick.bind(this, id)}
        style={getContainerStyle()}
    >
        <Image
            $selectable={selectable}
            src={cover}
            style={getImageStyle()}
            alt={name}
        />
    </Card>
}
