import React from 'react';
import memory from '../../icons/memory.svg';
import GenericSelector from "./GenericSelector";

const options = {
    1: '1 GB',
    2: '2 GB',
    3: '3 GB',
    4: '4 GB',
    5: '5 GB',
    6: '6 GB',
};

export default function MemorySelector({onSelect}) {
    return <GenericSelector
        title="Memory"
        subtitle="Maximum memory usage"
        icon={memory}
        onSelect={onSelect}
        options={options}
    />;
}
