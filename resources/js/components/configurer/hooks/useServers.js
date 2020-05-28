import React from 'react';
import {useSelector} from "react-redux";

export default function useServers() {
    return useSelector(state => state.servers);
}
