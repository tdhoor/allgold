import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'
import Refill from '../utils/Refill'

export default class RefillService {
    constructor() {}

    static store(refill) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/refills', refill.toJSON())
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
                        resolve(result.data)
                    }
                    resolve(false)
                })
                .catch(error => console.error(error))
        })
    }

    static update(refill) {
        let newRefill = new Refill(refill)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .put(
                    SERVER_URL + 'api/refills',
                    newRefill.refillId,
                    newRefill.toJSON()
                )
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    }
                })
                .catch(error => console.log(error))
        })
    }
}
