export default class Shoppingcar {
    constructor({ productid = null, saleid = null, amount = null }) {
        this._productid = productid
        this._saleid = saleid
        this._amount = amount
    }

    toJSON() {
        return {
            productid: this._productid,
            saleid: this._saleid,
            amount: this._amount
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
    set productid(productid) {
        this._productid = parseInt(productid)
    }
    set saleid(saleid) {
        this._saleid = parseInt(saleid)
    }
    set amount(amount) {
        this._amount = parseInt(amount)
    }
}
