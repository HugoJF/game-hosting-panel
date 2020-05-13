import React from 'react';
import {useSelector} from "react-redux";

export default function useForm() {
    return useSelector(state => state.form);
}
