export default class Station {
    constructor({
        stationid = null,
        coordsA = null,
        coordsB = null,
        type = null,
        description = null
    }) {
        this._stationid = stationid
        this._coordsA = coordsA
        this._coordsB = coordsB
        this._type = type
        this._description = description
    }
    toJSON() {
        return {
            stationid: this._stationid,
            coordsA: this._coordsA,
            coordsB: this._coordsB,
            type: this._type,
            description: this._description
        }
    }
    get stationid() {
        return this._stationid === null ? undefined : this._stationid
    }
    get coordsA() {
        return this._coordsA === null ? undefined : this._coordsA
    }
    get coordsB() {
        return this._coordsB === null ? undefined : this._coordsB
    }
    get type() {
        return this._type === null ? undefined : this._type
    }
    get description() {
        return this._description === null ? undefined : this._description
    }
    set stationid(stationid) {
        this._stationid = parseInt(stationid)
    }
    set coordsA(coordsA) {
        this._coordsA = parseInt(coordsA)
    }
    set coordsB(coordsB) {
        this._coordsB = Number(coordsB.toFixed(2))
    }
    set type(type) {
        this._type = parseInt(type)
    }
    set description(description) {
        this._description = Number(description.toFixed(2))
    }
}
