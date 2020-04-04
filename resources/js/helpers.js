export const calculateUnits = (balance, unitPrice, discountPerUnit, unitPriceLimit) => {
    let u = 0;
    let pricePerUnit = unitPrice;

    while (balance >= pricePerUnit) {
        u++;
        balance -= pricePerUnit;
        pricePerUnit -= discountPerUnit;
        if (pricePerUnit < unitPriceLimit)
            pricePerUnit = unitPriceLimit;
    }

    return u + balance / pricePerUnit;
};