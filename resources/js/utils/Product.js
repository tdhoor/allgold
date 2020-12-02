export default class Product {
    constructor({
        productId = null,
        title = null,
        name = null,
        price = null,
        durability = null,
        created_at = null,
        updated_at = null
    }) {
        this.productId = productId
        this.title = title
        this.name = name
        this.price = price
        this.durability = durability
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            productId: this._productId,
            title: this._title,
            name: this._name,
            price: this._price,
            durability: this._durability,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get productId() {
        return this._productId === null ? undefined : this._productId
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
    get created_at() {
        return this._created_at === null ? undefined : this._created_at
    }
    get updated_at() {
        return this._updated_at === null ? undefined : this._updated_at
    }
    set productId(productId) {
        this._productId = parseInt(productId)
    }
    set title(title) {
        this._title = title
    }
    set name(name) {
        this._name = name
    }
    set price(price) {
        this._price = Number(Math.round(price * 100) / 100)
    }
    set durability(durability) {
        this._durability = parseInt(durability)
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
