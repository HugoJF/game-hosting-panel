import React from 'react';
import disk from './../icons/disk.svg';
import GenericSelector from "./GenericSelector";

const options = {
    10: '10 GB',
    20: '20 GB',
    30: '30 GB',
    40: '40 GB',
    50: '50 GB',
};

export default function DiskSelector({onSelect}) {
    return <GenericSelector
        title="Disk"
        subtitle="Maximum disk usage"
        icon={disk}
        onSelect={onSelect}
        options={options}
    />;
}
