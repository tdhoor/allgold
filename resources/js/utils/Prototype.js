export default class Prototype {
    constructor({
        stationId = null,
        productId = null,
        inventoryId = null,
        currentAmount = null,
        targetAmount = null,
        durability = null,
        status = null,
        amount = null
    }) {
        this.stationId = stationId
        this.productId = productId
        this.inventoryId = inventoryId
        this.currentAmount = currentAmount
        this.targetAmount = targetAmount
        this.durability = durability
        this.status = status || 'offen'
        this.amount = amount || 0
    }
    toJSON() {
        return {
            stationId: this._stationId,
            productId: this._productId,
            inventoryId: this._inventoryId,
            currentAmount: this._currentAmount,
            targetAmount: this._targetAmount,
            durability: this._durability,
            status: this.status,
            amount: this.amount
        }
    }
    toModalJSON() {
        return {
            stationId: this._stationId,
            productId: this._productId,
            inventoryId: this._inventoryId,
            currentAmount_hide: this._currentAmount,
            targetAmount_hide: this._targetAmount,
            durability_hide: this._durability,
            status_hide: this.status,
            amount: this.amount
        }
    }
    get stationId() {
        return this._stationId === null ? undefined : this._stationId
    }
    get productId() {
        return this._productId === null ? undefined : this._productId
    }
    get inventoryId() {
        return this._inventoryId === null ? undefined : this._inventoryId
    }
    get currentAmount() {
        return this._currentAmount === null ? undefined : this._currentAmount
    }
    get targetAmount() {
        return this._targetAmount === null ? undefined : this._targetAmount
    }
    get durability() {
        return this._durability === null ? undefined : this._durability
    }
    get status() {
        return this._status === null ? undefined : this._status
    }
    get amount() {
        return this._amount === null ? undefined : this._amount
    }
    set productId(productId) {
        this._productId = parseInt(productId)
    }
    set stationId(stationId) {
        this._stationId = parseInt(stationId)
    }
    set inventoryId(inventoryId) {
        this._inventoryId = parseInt(inventoryId)
    }
    set currentAmount(currentAmount) {
        this._currentAmount = Number(Math.round(currentAmount * 100) / 100)
    }
    set targetAmount(targetAmount) {
        this._targetAmount = parseInt(targetAmount)
    }
    set durability(durability) {
        this._durability = parseInt(durability)
    }
    set status(status) {
        this._status = status
    }
    set amount(amount) {
        this._amount = parseInt(amount)
    }
}
