import React from 'react';
import {useSelector} from "react-redux";

export default function usePeriods() {
    return useSelector(state => state.periods);
}
