import React from 'react';
import databases from '../../icons/databases.svg';
import GenericSelector from "./GenericSelector";

const options = {
    0: '0',
    1: '1',
    2: '2',
    3: '3',
};

export default function DatabasesSelector({onSelect}) {
    return <GenericSelector
        title="Databases"
        subtitle="Maximum database tables"
        icon={databases}
        onSelect={onSelect}
        options={options}
    />;
}
