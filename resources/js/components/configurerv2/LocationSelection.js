import React, {useState} from 'react';
import Card from "./Card";
import Brazil from "../flags/Brazil.svg";
import UnitedStates from "../flags/UnitedStates.svg";
import Canada from "../flags/Canada.svg";
import Location from "./Location";
import useLocations from "./useLocations";

const flags = {
    brazil: Brazil,
    us: UnitedStates,
    canada: Canada,
};

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
                flag={flags[id]}
                location={location}
                selected={selected === id}
                onClick={handleOnClick.bind(this, id)}
            />
        })}
    </Card>
}
