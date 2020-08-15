import React from 'react';
import Card from "../ui/Card";
import Button from "../ui/Button";

export default function ModeSelection({selected, onSelect}) {
    function handleOnClick(id) {
        onSelect && onSelect(selected === id ? null : id);
    }

    return <Card
        title="Mode"
        subtitle="Select simple if you don't know that you are doing"
    >
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            <Button
                onClick={handleOnClick.bind(this, 'simple')}
                selected={selected === 'simple'}
            >
                Simple
            </Button>
            <Button
                onClick={handleOnClick.bind(this, 'advanced')}
                selected={selected === 'advanced'}
            >
                Advanced
            </Button>
        </div>
    </Card>
}
