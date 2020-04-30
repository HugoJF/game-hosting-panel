import React from 'react';

export default function () {
    return <div className="my-2 form-group">
        <select name="period" className="form-control form-control-lg" required>
            <option>=== Periodo de pagamento ===</option>
            <option value="hourly">Por hora</option>
            <option value="daily">Por dia</option>
            <option value="weekly">Por semana</option>
            <option value="monthly">Por mes</option>
        </select>
    </div>
}
