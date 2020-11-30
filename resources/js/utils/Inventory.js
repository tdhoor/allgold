export default class Inventory {
    constructor({
        inventoryId = null,
        fk_inventoryId = null,
        fk_stationId = null,
        currentAmount = null,
        targetAmount = null,
        created_at = null,
        updated_at = null
    }) {
        this.inventoryId = inventoryId
        this.fk_inventoryId = fk_inventoryId
        this.fk_stationId = fk_stationId
        this.currentAmount = currentAmount
        this.targetAmount = targetAmount
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            inventoryId: this._inventoryId,
            fk_inventoryId: this._fk_inventoryId,
            fk_stationId: this._fk_stationId,
            currentAmount: this._currentAmount,
            targetAmount: this._targetAmount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get inventoryId() {
        return this._inventoryId === null ? undefined : this._inventoryId
    }
    get fk_inventoryId() {
        return this._fk_inventoryId === null ? undefined : this._fk_inventoryId
    }
    get fk_stationId() {
        return this._fk_stationId === null ? undefined : this._fk_stationId
    }
    get currentAmount() {
        return this._currentAmount === null ? undefined : this._currentAmount
    }
    get targetAmount() {
        return this._targetAmount === null ? undefined : this._targetAmount
    }
    get created_at() {
        return this._created_at === null ? undefined : this._created_at
    }
    get updated_at() {
        return this._updated_at === null ? undefined : this._updated_at
    }
    set inventoryId(inventoryId) {
        this._inventoryId = parseInt(inventoryId)
    }
    set fk_inventoryId(fk_inventoryId) {
        this._fk_inventoryId = parseInt(fk_inventoryId)
    }
    set fk_stationId(fk_stationId) {
        this._fk_stationId = Number(fk_stationId)
    }
    set currentAmount(currentAmount) {
        this._currentAmount = parseInt(currentAmount)
    }
    set targetAmount(targetAmount) {
        this._targetAmount = Number(targetAmount)
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
