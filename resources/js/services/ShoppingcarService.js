import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class ShoppingcarService {
    constructor() {}

    static store(shoppingcar) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'api/shoppingcars', shoppingcar.toJSON())
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
