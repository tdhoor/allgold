export default class Refill {
    constructor({
        refillId = null,
        stationId = null,
        amount = null,
        created_at = null,
        updated_at = null
    }) {
        this.refillId = refillId
        this.stationId = stationId
        this.amount = amount
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            refillId: this._refillId,
            stationId: this._stationId,
            amount: this._amount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get refillId() {
        return this._refillId === null ? undefined : this._refillId
    }
    get stationId() {
        return this._stationId === null ? undefined : this._stationId
    }
    get amount() {
        return this._amount === null ? undefined : this._amount
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
    set stationId(stationId) {
        this._stationId = parseInt(stationId)
    }
    set amount(amount) {
        this._amount = Number(amount.toFixed(2))
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
