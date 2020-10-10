import React from 'react';
import {useSelector} from "react-redux";
import useCost from "./useCost";
import useForm from "./useForm";

export default function useValidForm() {
    const cost = useCost();
    const form = useForm();

    const _cost = cost.value / 100;
    const validCost = !isNaN(_cost) && cost.value > 0;
    const hasName = form.name;

    return validCost && hasName;
}
