import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'
import Station from '../utils/Station'

export default class StationService {
    constructor() {}

    static getAll() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/stations')
                .then(result => {
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }

    static getOne(stationid) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/stations/' + stationid)
                .then(result => {
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }

    static update(station) {
        let id = station.stationid
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .put(SERVER_URL + 'api/stations', id, station)
                .then(result => {
                    resolve(new Station(result.data))
                })
                .catch(error => console.error(error))
        })
    }
}
