export default class Refill {
    constructor({
        refillId = null,
        fk_stationId = null,
        fk_productId = null,
        productId = null,
        stationId = null,
        amount = null,
        status = 'offen',
        created_at = null,
        updated_at = null
    }) {
        this.refillId = refillId
        this.fk_stationId = fk_stationId || stationId
        this.fk_productId = fk_productId || productId
        this.amount = amount
        this.status = status
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            refillId: this._refillId,
            fk_stationId: this._fk_stationId,
            fk_productId: this._fk_productId,
            amount: this._amount,
            status: this._status,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    toModalJSON() {
        return {
            refillId: this._refillId,
            fk_stationId: this._fk_stationId,
            fk_productId: this._fk_productId,
            amount_hide: this._amount,
            status: this._status,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get refillId() {
        return this._refillId === null ? undefined : this._refillId
    }
    get fk_stationId() {
        return this._fk_stationId === null ? undefined : this._fk_stationId
    }
    get fk_productId() {
        return this._fk_productId === null ? undefined : this._fk_productId
    }
    get amount() {
        return this._amount === null ? undefined : this._amount
    }
    get status() {
        return this._status === null ? undefined : this._status
    }
    get created_at() {
        return this._created_at === null ? undefined : this._created_at
    }
    get updated_at() {
        return this._updated_at === null ? undefined : this._updated_at
    }
    set refillId(refillId) {
        this._refillId = parseInt(refillId)
    }
    set fk_stationId(fk_stationId) {
        this._fk_stationId = parseInt(fk_stationId)
    }
    set fk_productId(fk_productId) {
        this._fk_productId = parseInt(fk_productId)
    }
    set amount(amount) {
        this._amount = parseInt(amount)
    }
    set status(status) {
        this._status = status
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
