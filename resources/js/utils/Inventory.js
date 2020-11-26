export default class Inventory {
    constructor({
        inventoryid = null,
        fk_inventoryid = null,
        fk_stationid = null,
        currentAmount = null,
        targetAmount = null,
        created_at = null,
        updated_at = null
    }) {
        this._inventoryid = inventoryid
        this._fk_inventoryid = fk_inventoryid
        this._fk_stationid = fk_stationid
        this._currentAmount = currentAmount
        this._targetAmount = targetAmount
        this._created_at = created_at
        this._updated_at = updated_at
    }
    toJSON() {
        return {
            inventoryid: this._inventoryid,
            fk_inventoryid: this._fk_inventoryid,
            fk_stationid: this._fk_stationid,
            currentAmount: this._currentAmount,
            targetAmount: this._targetAmount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get inventoryid() {
        return this._inventoryid === null ? undefined : this._inventoryid
    }
    get fk_inventoryid() {
        return this._fk_inventoryid === null ? undefined : this._fk_inventoryid
    }
    get fk_stationid() {
        return this._fk_stationid === null ? undefined : this._fk_stationid
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
    set inventoryid(inventoryid) {
        this._inventoryid = parseInt(inventoryid)
    }
    set fk_inventoryid(fk_inventoryid) {
        this._fk_inventoryid = parseInt(fk_inventoryid)
    }
    set fk_stationid(fk_stationid) {
        this._fk_stationid = Number(fk_stationid.toFixed(2))
    }
    set currentAmount(currentAmount) {
        this._currentAmount = parseInt(currentAmount)
    }
    set targetAmount(targetAmount) {
        this._targetAmount = Number(targetAmount.toFixed(2))
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
