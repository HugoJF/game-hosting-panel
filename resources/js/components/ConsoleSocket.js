import socketIO from "socket.io-client";

let _socket = null;
export const socket = () => _socket;

export const setup = (ep, jwt) => {
    console.log('Setting up socket');
    _socket = socketIO(ep, {
        query: {jwt}
    });


    // socket.on('connect', a => {
    //     socket.emit('subscribe-home', 'inside', () => alert('inside'));
    // });
    // socket.on('logs', log => {
    //     console.log(log)
    // });
    // socket.emit('subscribe-home', 'out', () => alert('out'));
};
