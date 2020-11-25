export default class Product {
    constructor({
        productid = null,
        title = null,
        name = null,
        price = null,
        durability = null
    }) {
        this._productid = productid
        this._title = title
        this._name = name
        this._price = price
        this._durability = durability
    }
    toJSON() {
        return {
            productid: this._productid,
            title: this._title,
            name: this._name,
            price: this._price,
            durability: this._durability
        }
    }
    get productid() {
        return this._productid === null ? undefined : this._productid
    }
    get title() {
        return this._title === null ? undefined : this._title
    }
    get name() {
        return this._name === null ? undefined : this._name
    }
    get price() {
        return this._price === null ? undefined : this._price
    }
    get durability() {
        return this._durability === null ? undefined : this._durability
    }
    set productid(productid) {
        this._productid = parseInt(productid)
    }
    set title(title) {
        this._title = parseInt(title)
    }
    set name(name) {
        this._name = Number(name.toFixed(2))
    }
    set price(price) {
        this._price = parseInt(price)
    }
    set durability(durability) {
        this._durability = Number(durability.toFixed(2))
    }
}
