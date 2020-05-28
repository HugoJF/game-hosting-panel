import React from 'react';
import domElements from "./domElements";

// Filters props prefixed with $ to avoid passing React props to DOM elements.
// Props prefixed with $ reach the DOM.
const filterProps = (props) => {
    const filtered = {};
    const domProp = /^\$/;

    for (let key in props) {
        if (!props.hasOwnProperty(key)) continue;

        if (domProp.test(key)) {
            filtered[key.substr(1)] = props[key];
        }
    }

    return filtered;
};

const createConstructor = (type) => function (template) {
    return function (props) {
        const {className: preClassName, children} = props;

        const result = template(props);

        const className = [result, preClassName].join(' ').replace(/\s+/g, ' ').trim();

        return React.createElement(type, {...filterProps(props), className}, children);
    };
};

const tailwind = domElements.reduce((prev, cur) => {
    prev[cur] = createConstructor(cur);

    return prev;
}, {});

export default tailwind;
