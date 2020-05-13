import React from 'react';
import Card from "./Card";
import Section from "./Section";
import summary from './../icons/summary.svg';
import costIcon from './../icons/cost.svg';
import PeriodSelector from "./PeriodSelector";
import useSpecs from "./useSpecs";
import useCost from "./useCost";

const specs = {
    'Game': 'Call of Duty 4: Modern Warfare',
    'CPU': '25%',
    'Memory': '2 GB',
    'Disk': '30 GB',
    'Databases': '1 database',
    'Period': 'Daily',
};
const formatter = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });

export default function Summary({onPeriodSelect}) {
    const specs = useSpecs();
    const cost = useCost();

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
            {Object.entries(specs).filter(([k, v]) => v).map(([name, value]) => (
                <div className="trans flex justify-between px-4 py-2 text-black text-center border rounded">
                    <h4>{name}:</h4>
                    {value}
                </div>
            ))}
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
