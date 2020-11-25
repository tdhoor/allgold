import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

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
}
