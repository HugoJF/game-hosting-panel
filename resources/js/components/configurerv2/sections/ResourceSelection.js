import React from 'react';
import Card from "../ui/Card";
import CpuSelector from "../resources/CpuSelector";
import MemorySelector from "../resources/MemorySelector";
import DiskSelector from "../resources/DiskSelector";
import DatabasesSelector from "../resources/DatabasesSelector";

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
