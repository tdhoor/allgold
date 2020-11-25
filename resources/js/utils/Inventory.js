export default class Inventory {
    constructor({
        inventoryid = null,
        fk_inventoryid = null,
        fk_stationid = null,
        currentAmount = null,
        targetAmount = null
    }) {
        this._inventoryid = inventoryid
        this._fk_inventoryid = fk_inventoryid
        this._fk_stationid = fk_stationid
        this._currentAmount = currentAmount
        this._targetAmount = targetAmount
    }
    toJSON() {
        return {
            inventoryid: this._inventoryid,
            fk_inventoryid: this._fk_inventoryid,
            fk_stationid: this._fk_stationid,
            currentAmount: this._currentAmount,
            targetAmount: this._targetAmount
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
}
