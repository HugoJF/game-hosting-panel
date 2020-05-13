import React from 'react';
import {useSelector} from "react-redux";

export default function useLocations() {
    return useSelector(state => state.locations);
}
