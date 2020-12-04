import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class RefillService {
    constructor() {}

    static store(sale) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/refills', sale.toJSON())
                .then(result => {
                    if (result) {
                        resolve(result)
                    }
                    resolve(false)
                })
                .catch(error => console.error(error))
        })
    }
    static getAll() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/refills')
                .then(result => {
                    if (result) {
                        resolve(result)
                    }
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }
}
