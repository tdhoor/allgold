export default class Station {
    constructor({
        stationid = null,
        coordsA = null,
        coordsB = null,
        type = null,
        description = null,
        created_at = null,
        updated_at = null
    }) {
        this._stationid = stationid
        this._coordsA = coordsA
        this._coordsB = coordsB
        this._type = type
        this._description = description
        this._created_at = created_at
        this._updated_at = updated_at
    }
    toJSON() {
        return {
            stationid: this._stationid,
            coordsA: this._coordsA,
            coordsB: this._coordsB,
            type: this._type,
            description: this._description,
            created_at: this._created_at,
            updated_at: this._updated_at
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
    get created_at() {
        return this._created_at === null ? undefined : this._created_at
    }
    get updated_at() {
        return this._updated_at === null ? undefined : this._updated_at
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
    set created_at(created_at) {
        this._created_at = created_at
    }
    set updated_at(updated_at) {
        this._updated_at = updated_at
    }
}
