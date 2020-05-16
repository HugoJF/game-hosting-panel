import React from 'react';
import {useDispatch} from "react-redux";
import useServers from "../hooks/useServers";
import useForm from "../hooks/useForm";
import Loader from "../ui/Loader";
import Error from "../ui/Error";
import get from 'lodash.get';
import tailwind from "../tailwind";

const OrderButton = tailwind.div(() => `
    trans px-5 py-3 bg-green-500 text-center text-3xl text-white font-semibold rounded cursor-pointer hover:shadow
`);

const Center = tailwind.div(() => `
    flex justify-center
`);

export default function SummaryCreateButton() {
    const dispatch = useDispatch();
    const form = useForm();
    const servers = useServers();

    async function handleOnClick() {
        let server = await dispatch.servers.create(form);

        if (server === false) return;

        let url = get(server, 'data.links.show');

        if (url) {
            window.location.href = url;
        } else {
            console.error(server);
            dispatch.servers.setError('Response from API is missing data.links.show');
        }
    }

    return servers.loading
        ?
        <Center>
            <Loader/>
        </Center>
        :
        (
            servers.error
                ?
                <Error title="Error while creating server!">
                    {servers.error}
                </Error>
                :
                <OrderButton $onClick={handleOnClick}>
                    Finalizar pedido
                </OrderButton>
        )
}
