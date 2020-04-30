import React from 'react';
import CartPeriodSelector from "./CartPeriodSelector";
import CartTotalCost from "./CartTotalCost";
import CartSummary from "./CartSummary";

export default function ({parameters, state, totalCost}) {

    return <div className="p-4 w-1/3">
        {/* Header */}
        <div className="flex items-center px-6 py-4 text-3xl text-gray-100 bg-gray-900 rounded-t-lg shadow-lg">
            Resumo
        </div>

        {/* Accent */}
        <div className="w-full h-1 bg-green-600"/>

        {/* Body */}
        <div className="p-4 bg-gray-100 border border-t-0 rounded-b-lg">
            <div className="flex flex-col text-xl">
                <CartSummary parameters={parameters} state={state}/>

                <hr className="my-2"/>

                <CartPeriodSelector/>

                <hr className="my-2"/>

                <CartTotalCost cost={totalCost}/>
            </div>

            <button
                className="w-full mt-4 px-6 py-4 bg-green-600 font-normal text-center text-gray-100 text-2xl tracking-wide rounded-lg shadow-md"
                type="submit"
            >
                Finalizar
            </button>
        </div>
    </div>
}
