export default class Station {
    constructor({
        stationid = null,
        location = null,
        coordsA = null,
        coordsB = null,
        type = null,
        description = null,
        created_at = null,
        updated_at = null
    }) {
        this.stationid = stationid
        this.location = location
        this.coordsA = coordsA
        this.coordsB = coordsB
        this.type = type
        this.description = description
        this.created_at = created_at
        this.updated_at = updated_at
    }
    toJSON() {
        return {
            stationid: this._stationid,
            location: this._location,
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
    get location() {
        return this._location === null ? undefined : this._location
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
        this._stationid = Number(stationid)
    }
    set location(location) {
        this._location = String(location)
    }
    set coordsA(coordsA) {
        this._coordsA = Number(coordsA)
    }
    set coordsB(coordsB) {
        this._coordsB = Number(coordsB)
    }
    set type(type) {
        this._type = String(type)
    }
    set description(description) {
        this._description = String(description)
    }
    set created_at(created_at) {
        this._created_at = String(created_at)
    }
    set updated_at(updated_at) {
        this._updated_at = String(updated_at)
    }
}
