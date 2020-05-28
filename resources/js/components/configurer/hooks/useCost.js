import React from 'react';
import {useSelector} from "react-redux";

export default function useCost() {
    return useSelector(state => state.cost);
}
