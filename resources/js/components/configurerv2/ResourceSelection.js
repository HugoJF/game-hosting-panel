import React from 'react';
import Card from "./Card";
import CpuSelector from "./CpuSelector";
import MemorySelector from "./MemorySelector";
import DiskSelector from "./DiskSelector";
import DatabasesSelector from "./DatabasesSelector";

export default function ResourceSelection({onSelect}) {
    function generateOnClick(key) {
        return (value) => onSelect && onSelect({[key]: value});
    }

    return <Card
        title="Server resources"
        subtitle="Select the resource limits based on your demand."
        cols={2}
        gap={8}
    >
        <CpuSelector onSelect={generateOnClick('cpu')}/>
        <MemorySelector onSelect={generateOnClick('memory')}/>
        <DiskSelector onSelect={generateOnClick('disk')}/>
        <DatabasesSelector onSelect={generateOnClick('databases')}/>
    </Card>
}
