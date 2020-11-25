import { SERVER_URL } from '../server/Server'
import ApiService from '../service/ApiService'

export default class SaleService {
    constructor() {}

    store(sale) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'verkauf/store', sale)
                .then(result => {
                    if (result) {
                        resolve(result)
                    }
                    resolve(false)
                })
                .catch(error => console.error(error))
        })
    }

    getNewKey() {
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
