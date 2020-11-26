export default class Shoppingcar {
    constructor({
        productid = null,
        saleid = null,
        amount = null,
        created_at = null,
        updated_at = null
    }) {
        this._productid = productid
        this._saleid = saleid
        this._amount = amount
        this._created_at = created_at
        this._updated_at = updated_at
    }

    toJSON() {
        return {
            productid: this._productid,
            saleid: this._saleid,
            amount: this._amount,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get productid() {
        return this._productid === null ? undefined : this._productid
    }
    get saleid() {
        return this._saleid === null ? undefined : this._saleid
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
    set productid(productid) {
        this._productid = parseInt(productid)
    }
    set saleid(saleid) {
        this._saleid = parseInt(saleid)
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
