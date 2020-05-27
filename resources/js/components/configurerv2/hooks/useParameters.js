import React from 'react';
import {useSelector} from "react-redux";

export default function useParameters() {
    return useSelector(state => state.parameters);
}
