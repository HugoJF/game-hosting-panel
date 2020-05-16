import React from 'react';
import feather from 'feather-icons';

export default function Error({title, children}) {
    const _title = title || children || 'Error';
    return <div className="px-5 py-4 flex bg-red-200 text-red-600 border border-red-600 rounded shadow">
        <div className="pr-4" dangerouslySetInnerHTML={{__html: feather.icons['alert-circle'].toSvg()}}/>

        <div>
            <p className="flex-grow font-semibold">{_title}</p>
            {
                title &&
                <p className="mt-2 ml-2 text-xs font-thin font-mono">{children}</p>
            }
        </div>
    </div>
}
