import React from 'react';

export default function ({parameters, state, totalCost}) {
    const formatter = new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'});
    return <div className="p-4 w-1/3">
        <div className="bg-green-600 rounded-t-lg rounded-b-lg">
            <div className="flex items-center px-6 py-4 mb-1 text-3xl text-gray-100 bg-gray-900 rounded-t-lg shadow-lg">
                Resumo
            </div>
            <div className="p-4 bg-gray-100 border border-t-0 rounded-b-lg">
                <div className="flex flex-col text-xl">
                    {
                        Object
                            .entries(state)
                            .filter(([key]) => Object.keys(parameters).includes(key))
                            .map(([key, value]) => (
                                <div className="flex justify-between">
                                    <div className="font-bold text-gray-700">
                                        {parameters[key].name}
                                    </div>
                                    <p className="">
                                        {
                                            Object
                                                .values(parameters[key].options)
                                                .filter(e => e.value === Number(value))
                                                [0].label
                                        }
                                    </p>
                                </div>
                            ))
                    }

                    <hr className="my-2"/>

                    <div className="my-2 form-group">
                        <select name="period" className="form-control form-control-lg" required>
                            <option>=== Periodo de pagamento ===</option>
                            <option value="hourly">Por hora</option>
                            <option value="daily">Por dia</option>
                            <option value="weekly">Por semana</option>
                            <option value="monthly">Por mes</option>
                        </select>
                    </div>

                    <hr className="my-2"/>

                    <div className="flex justify-between text-2xl">
                        <p className="font-bold text-gray-700">
                            TOTAL
                        </p>
                        <p className="font-bold">{formatter.format(totalCost / 100)}</p>
                    </div>

                </div>
                <button
                    className="w-full mt-4 px-6 py-4 bg-green-600 font-normal text-center text-gray-100 text-2xl tracking-wide rounded-lg shadow-md"
                    type="submit"
                >
                    Finalizar
                </button>
            </div>
        </div>
    </div>
}
