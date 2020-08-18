import React from 'react';
import Loader from "./Loader";

export default function Gate({ready, children}) {
    return ready ?
        children
        :
        <Loader/>
}
