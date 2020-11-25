export default class Sale {
    constructor({ saleid = null, stationid = null, totalprice = null }) {
        this._saleid = saleid
        this._stationid = stationid
        this._totalprice = totalprice
    }
    toJSON() {
        return {
            saleid: this._saleid,
            stationid: this._stationid,
            totalprice: this._totalprice
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
}
