import React from 'react';

export default function Game({id, game, selected, onClick}) {
    const scaled = {transform: 'scale(1.05)'};
    const muted = {transform: 'scale(1.01)', filter: 'blur(1px) grayscale(100%) brightness(60%)'};

    const {name, cover} = game;

    function getContainerStyle() {
        return selected ? scaled : {};
    }

    function getImageStyle() {
        return selected === null || selected ? {} : muted;
    }

    return <div
        onClick={onClick.bind(this, id)}
        className="trans relative rounded overflow-hidden"
        style={getContainerStyle()}
    >
        {/* Image */}
        <img
            className="z-0 trans cursor-pointer shadow-lg"
            src={cover}
            style={getImageStyle()}
            alt={name}
        />
    </div>
}
