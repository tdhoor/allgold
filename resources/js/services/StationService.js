import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'
import Station from '../utils/Station'

export default class StationService {
    constructor() {}

    static getAll() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/stations')
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => reject(error))
        })
    }

    static getOne(stationid) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/stations/' + stationid)
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => reject(error))
        })
    }

    static create(station) {
        let tempStation = new Station(station)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/stations', tempStation.toJSON())
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    }
                })
                .catch(error => reject(error))
        })
    }

    static update(station) {
        let tempStation = new Station(station)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .put(
                    SERVER_URL + 'api/stations',
                    station.stationId,
                    tempStation.toJSON()
                )
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    }
                })
                .catch(error => console.log(error))
        })
    }

    static getByLocationOrId(searchValue) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/stations/' + searchValue)
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => console.log(error))
        })
    }

    static delete(id) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .delete(SERVER_URL + 'api/stations', id)
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    }
                })
                .catch(error => console.log(error))
        })
    }
}
