import React, {useEffect} from 'react';
import Card from "../ui/Card";
import Location from "./../sections/partials/Location";
import useLocations from "../hooks/useLocations";
import {useDispatch} from "react-redux";
import Button from "../ui/Button";

export default function ModeSelection({selected, onSelect}) {
    function handleOnClick(id) {
        onSelect && onSelect(selected === id ? null : id);
    }

    return <Card
        title="Mode"
        subtitle="Select simple if you don't know that you are doing"
    >
        <Button
            onClick={handleOnClick.bind(this, 'simple')}
            selected={selected === 'simple'}
        >Simple</Button>
        <Button
            onClick={handleOnClick.bind(this, 'advanced')}
            selected={selected === 'advanced'}
        >Advanced</Button>
    </Card>
}
