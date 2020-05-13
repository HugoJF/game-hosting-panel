import React, {useState} from 'react';
import Card from "../ui/Card";
import Location from "./../sections/partials/Location";
import useLocations from "../hooks/useLocations";

export default function LocationSelection({onSelect}) {
    const [selected, setSelected] = useState(null);
    const locations = useLocations();

    function handleOnClick(id) {
        let n = selected === id ? null : id;
        setSelected(n);
        onSelect && onSelect(n);
    }

    return <Card
        title="Location"
        subtitle="Where do you want the server to be hosted"
        loading={locations.loading}
    >
        {Object.entries(locations.locations).map(([id, location]) => {
            return <Location
                id={id}
                location={location}
                selected={selected === id}
                onClick={handleOnClick.bind(this, id)}
            />
        })}
    </Card>
}
