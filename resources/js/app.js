import React from 'react';
import ReactDOM from 'react-dom';
import Console from "./components/Console";

let home = document.getElementById('console');
if (home) {
    let id = home.getAttribute('data-home-id');
    let host = home.getAttribute('data-ws-host');
    let jwt = home.getAttribute('data-ws-jwt');

    ReactDOM.render(<Console jwt={jwt} wsHost={host} homeId={id}/>, home);
}

