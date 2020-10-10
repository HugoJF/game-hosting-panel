import React from 'react';
import useServers from "../hooks/useServers";
import Loader from "../ui/Loader";
import Error from "../ui/Error";
import useCost from "../hooks/useCost";
import useValidForm from "../hooks/useValidForm";

const OrderButton = tailwind.div(() => `
    trans px-5 py-3 bg-green-500
    text-center text-3xl text-white font-semibold
    rounded cursor-pointer
    hover:bg-green-600 hover:shadow-md
`);

const Center = tailwind.div(() => `
    flex justify-center
`);

export default function SummarySubmitButton({onSubmit, text}) {
    const servers = useServers();
    const validForm = useValidForm();

    async function handleOnClick() {
        await onSubmit();
    }

    return <>
        {
            servers.loading &&
            <Center>
                <Loader/>
            </Center>
        }
        {
            servers.error &&
            <div className="mb-6">
                <Error title="Error while creating server!">
                    {servers.error}
                </Error>
            </div>
        }
        {
            !servers.loading && validForm &&
            <OrderButton onClick={handleOnClick}>
                {text}
            </OrderButton>
        }
    </>
}
