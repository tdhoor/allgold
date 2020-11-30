export default class Sale {
    constructor({
        saleId = null,
        stationId = null,
        totalprice = null,
        created_at = null,
        updated_at = null
    }) {
        this.saleId = saleId
        this.stationId = stationId
        this.totalprice = totalprice
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            saleId: this._saleId,
            stationId: this._stationId,
            totalprice: this._totalprice,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get saleId() {
        return this._saleId === null ? undefined : this._saleId
    }
    get stationId() {
        return this._stationId === null ? undefined : this._stationId
    }
    get totalprice() {
        return this._totalprice === null ? undefined : this._totalprice
    }
    get created_at() {
        return this._created_at === null ? undefined : this._created_at
    }
    get updated_at() {
        return this._updated_at === null ? undefined : this._updated_at
    }
    set saleId(saleId) {
        this._saleId = parseInt(saleId)
    }
    set stationId(stationId) {
        this._stationId = parseInt(stationId)
    }
    set totalprice(totalprice) {
        this._totalprice = Number(totalprice.toFixed(2))
    }
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
