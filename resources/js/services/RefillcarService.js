import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class RefillcarService {
    constructor() {}

    static store(shoppingcar) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/refillcars', shoppingcar.toJSON())
                .then(result => {
                    if (result) {
                        resolve(result)
                    }
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }
    static getAll() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/refillcars')
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
