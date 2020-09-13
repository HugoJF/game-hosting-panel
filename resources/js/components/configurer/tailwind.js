import React from 'react';
import domElements from "./domElements";

// Filters props prefixed with $ to avoid passing React props to DOM elements.
// Props prefixed with $ DO NOT reach the DOM.
// Props prefixed with $ are considered style-only props
const filterProps = (props) => {
    const stylePatterns = /^\$/;
    const styleProps = {};
    const domProps = {};

    for (let key in props) {
        if (!props.hasOwnProperty(key)) continue;

        if (stylePatterns.test(key)) {
            styleProps[key.substr(1)] = props[key];
        } else {
            domProps[key] = props[key];
        }
    }

    return {domProps, styleProps};
};

const createConstructor = (type) => function (template) {
    return function (props) {
        const {domProps, styleProps} = filterProps(props);
        const result = template({
            ...domProps,
            ...styleProps
        });

        const className = [result, props.className].join(' ').replace(/\s+/g, ' ').trim();

        return React.createElement(type, {
            ...domProps, className
        }, props.children);
    };
};

const tailwind = domElements.reduce((prev, cur) => {
    prev[cur] = createConstructor(cur);

    return prev;
}, {});

export default tailwind;
