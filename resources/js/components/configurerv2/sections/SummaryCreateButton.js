import React from 'react';
import {useDispatch} from "react-redux";
import useServers from "../hooks/useServers";
import Loader from "../ui/Loader";
import Error from "../ui/Error";
import useForm from "../hooks/useForm";

export default function SummaryCreateButton() {
    const dispatch = useDispatch();
    const form = useForm();
    const servers = useServers();

    function handleOnClick() {
        dispatch.servers.create(form);
        setTimeout(() => dispatch.servers.setLoading(false) && dispatch.servers.setError(null), 5000);
    }

    return servers.loading
        ?
        <div className="flex justify-center">
            <Loader/>
        </div>
        :
        (
            servers.error
                ?
            <Error title="Error while creating server!">
                {servers.error}
            </Error>
                :
                <div onClick={handleOnClick} className="trans px-5 py-3 bg-green-500 text-center text-3xl text-white font-semibold rounded cursor-pointer hover:shadow">
                    Finalizar pedido
                </div>
        )
}
