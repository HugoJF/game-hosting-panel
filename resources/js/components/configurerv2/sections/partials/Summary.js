import React from 'react';
import get from 'lodash.get';
import useCost from "../../hooks/useCost";
import useForm from "../../hooks/useForm";
import useSpecs from "../../hooks/useSpecs";
import summary from '../../../icons/summary.svg';
import costIcon from '../../../icons/cost.svg';
import PeriodSelector from "./../../sections/PeriodSelector";
import Card from "../../ui/Card";
import Section from "../../ui/Section";

const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});

export default function Summary({onPeriodSelect}) {
    const form = useForm();
    const specs = useSpecs();
    const cost = useCost();

    console.log(specs, form);

    return <Card
        title="Summary"
        subtitle="Details and cost for your new server"
        cols={2}
    >
        <Section
            title="Resumo"
            subtitle="Server specification"
            icon={summary}
            cols={1}
        >
            {
                Object.entries(form)
                    .filter(([k, v]) => v)
                    .map(([specId, optionId]) => (
                        <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                            <h4>{get(specs, `${specId}.name`, specId)}:</h4>
                            {get(specs, `${specId}.options.${optionId}`, optionId)}
                        </div>
                    ))
            }
        </Section>
        <div>
            <div className="mb-8">
                <PeriodSelector onSelect={onPeriodSelect}/>
            </div>
            <Section
                icon={costIcon}
                title="Total cost"
                cols={1}
            >
                <div>
                    <div className="flex mb-6 justify-center items-baseline text-3xl">
                        {cost.loading ? <>
                            <span>Carregando...</span>
                        </> : <>
                            <span>{formatter.format(cost.value)}</span>
                            <span className="ml-1 text-2xl text-gray-700 font-light tracking-tight">por dia</span>
                        </>}
                    </div>
                    <div className="trans px-5 py-3 bg-green-500 text-center text-3xl text-white font-semibold rounded cursor-pointer hover:shadow">
                        Finalizar pedido
                    </div>
                </div>
            </Section>
        </div>
    </Card>
}
