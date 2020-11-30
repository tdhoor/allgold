export default class Shoppingcar {
    constructor({
        productId = null,
        saleId = null,
        amount = null,
        created_at = null,
        updated_at = null
    }) {
        this.productId = productId
        this.saleId = saleId
        this.amount = amount
        this.created_at = created_at
        this.updated_at = updated_at
    }

    toJSON() {
        return {
            productId: this._productId,
            saleId: this._saleId,
            amount: this._amount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get productId() {
        return this._productId === null ? undefined : this._productId
    }
    get saleId() {
        return this._saleId === null ? undefined : this._saleId
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
    set productId(productId) {
        this._productId = parseInt(productId)
    }
    set saleId(saleId) {
        this._saleId = parseInt(saleId)
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
