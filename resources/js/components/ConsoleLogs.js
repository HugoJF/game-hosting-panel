import React, {useRef, useState, useEffect} from "react";
import {socket} from './ConsoleSocket';

export default function ConsoleLogs({homeId}) {
    const scroll = useRef(null);
    const [sticky, setSticky] = useState(true);
    const [logs, setLogs] = useState([]);

    const scr = scroll.current || {};

    function checkStickyScroll(e) {
        let t = e.target;
        let delta = t.scrollHeight - t.scrollTop - t.clientHeight;
        let _sticky = delta < 200 || isNaN(delta);
        setSticky(_sticky);
    }

    function addLog(type, log) {
        let _logs = [...logs, {type, log}];
        while (_logs.length > 500)
            _logs.shift();
        setLogs(_logs);
    }

    // Subscribe home events
    useEffect(() => {
        console.log(`Subscribing for home ${homeId} logs`);
        socket().emit('subscribe-home', homeId);
    }, []);

    // Listen for Socket.IO logs
    useEffect(() => {
        // Connection logs
        socket().on('info', log => {
            addLog('info', log);
        });

        // Connection errors
        socket().on('errors', log => {
            addLog('errors', log);
        });

        // Server stdout
        socket().on('home', log => {
            addLog('logs', log);
        });

        // Server updater stdout
        socket().on('update', log => {
            addLog('logs', log);
        });
        return () => {
            socket().removeListener('info');
            socket().removeListener('errors');
            socket().removeListener('home');
            socket().removeListener('update')
        };
    }, [logs]);

    // Stick scroll to bottom if height changed
    useEffect(() => {
        if (sticky)
            scr.scrollTop = scr.scrollHeight;
    });

    const color = {
        info: 'text-blue-500',
        errors: 'text-red-500',
        home: 'text-gray-100',
        update: 'text-blue-100',
    };

    const prefix = {
        info: '>> ',
        errors: '>> ',
        home: '',
        update: '',
    };

    return (
        <pre ref={scroll} onScroll={checkStickyScroll} style={{height: '400px'}} className="px-6 py-3 text-gray-100 leading-loose overflow-y-scroll">
            {
                logs.map(log => log.log.split('\n').map(p => <p className={[color[log.type]]}>{prefix[log.type]}{log.log}</p>))
            }
        </pre>
    );
};