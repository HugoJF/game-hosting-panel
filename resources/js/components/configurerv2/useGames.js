import React from 'react';
import {useSelector} from "react-redux";

export default function useGames() {
    return useSelector(state => state.games);
}
