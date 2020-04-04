import React, {useEffect} from 'react';
import ConsoleLogs from "./ConsoleLogs";
import ConsoleContainer from "./ConsoleContainer";
import ConsoleInput from "./ConsoleInput";
import {setup} from './ConsoleSocket';

let setupComplete = false;

export default function Console({jwt, wsHost, homeId}) {
    if(!setupComplete) setup(wsHost, jwt);

    return (
        <ConsoleContainer>
            <ConsoleLogs homeId={homeId}/>
            <ConsoleInput/>
        </ConsoleContainer>
    );
}