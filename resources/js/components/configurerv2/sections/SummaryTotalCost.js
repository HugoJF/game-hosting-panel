import React from 'react';
import costIcon from "../../icons/cost.svg";
import Section from "../ui/Section";
import useCost from "../hooks/useCost";

const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

export default function SummaryTotalCost() {
    const cost = useCost();

    return <Section
        icon={costIcon}
        title="Total cost"
        cols={1}
    >
        <div>
            <div className="flex mb-6 justify-center items-baseline text-3xl">
                {
                    cost.loading ? <>
                        <span>Carregando...</span>
                    </> : <>
                        <span>{formatter.format(cost.value)}</span>
                        <span className="ml-1 text-2xl text-gray-700 font-light tracking-tight">por dia</span>
                    </>
                }
            </div>
            <div className="trans px-5 py-3 bg-green-500 text-center text-3xl text-white font-semibold rounded cursor-pointer hover:shadow">
                Finalizar pedido
            </div>
        </div>
    </Section>
}
