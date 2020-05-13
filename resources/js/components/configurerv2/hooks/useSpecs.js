import React from 'react';
import {useSelector} from "react-redux";

export default function useSpecs() {
    return useSelector(state => state.specs);
}
