export default class Refillcar {
    constructor({
        fk_productId = null,
        fk_refillId = null,
        amount = null,
        created_at = null,
        updated_at = null
    }) {
        this.fk_productId = fk_productId
        this.fk_refillId = fk_refillId
        this.amount = amount
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            fk_productId: this._fk_productId,
            fk_refillId: this._fk_refillId,
            amount: this._amount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get fk_productId() {
        return this._fk_productId === null ? undefined : this._fk_productId
    }
    get fk_refillId() {
        return this._fk_refillId === null ? undefined : this._fk_refillId
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
    set fk_productId(fk_productId) {
        this._fk_productId = parseInt(fk_productId)
    }
    set fk_refillId(fk_refillId) {
        this._fk_refillId = parseInt(fk_refillId)
    }
    set amount(amount) {
        this._amount = parseInt(amount)
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
