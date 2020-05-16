import React from 'react';
import costIcon from "../../icons/cost.svg";
import Section from "../ui/Section";
import useCost from "../hooks/useCost";
import Loader from "../ui/Loader";
import SummaryCreateButton from "./SummaryCreateButton";

const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

export default function SummaryTotalCost() {
    const cost = useCost();

    return <Section
        icon={costIcon}
        title="Total cost"
        cols={1}
    >
        {/* Cost */}
        <div className="flex mb-6 justify-center items-baseline text-3xl">
            {
                cost.loading ? <>
                    <Loader/>
                </> : <>
                    <span>{formatter.format(cost.value / 100)}</span>
                    <span className="ml-1 text-2xl text-gray-700 font-light tracking-tight">por dia</span>
                </>
            }
        </div>

        {/* Button */}
        <SummaryCreateButton/>
    </Section>
}
