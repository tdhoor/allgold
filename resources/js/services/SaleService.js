import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class SaleService {
    constructor() {}

    static store(sale) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/sales', sale.toJSON())
                .then(result => {
                    if (result) {
                        resolve(result)
                    }
                    resolve(false)
                })
                .catch(error => console.error(error))
        })
    }

    static getNewKey() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'verkauf/getNewID')
                .then(result => {
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }
}
