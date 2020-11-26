export default class Sale {
    constructor({
        saleid = null,
        stationid = null,
        totalprice = null,
        created_at = null,
        updated_at = null
    }) {
        this._saleid = saleid
        this._stationid = stationid
        this._totalprice = totalprice
        this._created_at = created_at
        this._updated_at = updated_at
    }
    toJSON() {
        return {
            saleid: this._saleid,
            stationid: this._stationid,
            totalprice: this._totalprice,
            created_at: this._created_at,
            updated_at: this._updated_at
        }
    }
    get saleid() {
        return this._saleid === null ? undefined : this._saleid
    }
    get stationid() {
        return this._stationid === null ? undefined : this._stationid
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
    set saleid(saleid) {
        console.log('setid', saleid, ' type: ', typeof saleid)
        this._saleid = parseInt(saleid)
    }
    set stationid(stationid) {
        this._stationid = parseInt(stationid)
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
