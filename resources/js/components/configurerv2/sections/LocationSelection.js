import React, {useEffect, useState} from 'react';
import Card from "../ui/Card";
import Location from "./../sections/partials/Location";
import useLocations from "../hooks/useLocations";
import {useDispatch} from "react-redux";
import useForm from "../hooks/useForm";

export default function LocationSelection({onSelect}) {
    const dispatch = useDispatch();
    const form = useForm();
    const [selected, setSelected] = useState(null);
    const locations = useLocations();

    useEffect(() => {
        dispatch.locations.preLoad();
    }, []);

    function handleOnClick(id) {
        let n = selected === id ? null : id;
        setSelected(n);
        onSelect && onSelect(n);
    }

    console.log('rendered location selector');

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
