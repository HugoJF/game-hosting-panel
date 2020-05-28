import React from 'react';
import feather from "feather-icons";

export default function Feather({icon, ...rest}) {
    return <div
        dangerouslySetInnerHTML={{__html: feather.icons[icon].toSvg()}}
        {...rest}
    />
}
