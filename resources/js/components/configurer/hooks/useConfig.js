import React from 'react';
import {useSelector} from "react-redux";

export default function useConfig() {
    return useSelector(state => state.config);
}
