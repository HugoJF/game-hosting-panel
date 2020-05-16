import React from 'react';
import ScaleLoader from "react-spinners/ScaleLoader";

export default function Loader() {
    return <ScaleLoader
        color="#2d3748"
        width={6}
        height={50}
        margin={5}
    />
}
