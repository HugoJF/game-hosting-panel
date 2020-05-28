import React, {useEffect} from 'react';
import Card from "../ui/Card";
import Location from "./../sections/partials/Location";
import useLocations from "../hooks/useLocations";
import {useDispatch} from "react-redux";

export default function LocationSelection({selected, onSelect}) {
    const dispatch = useDispatch();
    const locations = useLocations();

    useEffect(() => {
        dispatch.locations.preLoad();
    }, []);

    function handleOnClick(id) {
        onSelect && onSelect(selected === id ? null : id);
    }

    return <Card
        title="Location"
        subtitle="Where do you want the server to be hosted"
        loading={locations.loading}
    >
        {
            Object
                .entries(locations.locations)
                .map(([id, location]) => {
                    return <Location
                        key={id}
                        id={id}
                        location={location}
                        selected={selected === id}
                        onClick={handleOnClick.bind(this, id)}
                    />
                })
        }
    </Card>
}
