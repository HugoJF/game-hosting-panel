import React, {useState, useRef, useEffect} from "react";
import {socket} from './ConsoleSocket';

const historyLimit = 100;

export default function ConsoleInput() {
    const input = useRef(null);
    const [index, setIndex] = useState(-1);
    const [history, setHistory] = useState([]);

    useEffect(() => {

    }, []);

    function handleSubmit(e) {
        // Emit event to Socket.IO server
        // TODO: POST to backend
        socket().emit('subscribe-home', e.target.value);

        // Send command to history
        history.unshift(e.target.value);
        if (history.length > historyLimit)
            history.pop();

        // Update history state
        setHistory(history);

        // Clear input
        e.target.value = '';

        // Reset history index
        setIndex(normalizedIndex(-1));
    }

    function normalizedIndex(index) {
        if (index < -1) return -1;
        if (index >= history.length) return history.length - 1;

        return index;
    }

    function handleBackHistory(e) {
        setIndex(normalizedIndex(index + 1));
    }

    function handleForwardHistory(e) {
        setIndex(normalizedIndex(index - 1));
    }

    useEffect(() => {
        // Input does not exists
        if (input === null) return;

        // Start with empty as default
        let value = '';

        // Update value according to history
        if (index !== -1)
            value = history[index];

        // Update input
        input.current.value = value;
    }, [index]);

    function handleKeyDown(e) {
        console.log('Pressed', e.key);

        // Map keys to functions
        let events = {
            'Enter': handleSubmit,
            'ArrowUp': handleBackHistory,
            'ArrowDown': handleForwardHistory,
        };

        // Call function and prevent default behavior
        let cb = events[e.key];
        if (cb !== undefined) {
            e.preventDefault();
            cb(e);
        }
    }

    return (
        <div className="flex p-3 w-full border-t border-gray-800">
            <span className="flex-grow-0">~/# </span>
            <input ref={input} onKeyDown={handleKeyDown} onSubmit={handleSubmit} className="pl-3 flex-grow bg-transparent outline-none" title="Command" name="command" type="text" autoComplete="off"/>
        </div>
    );
}