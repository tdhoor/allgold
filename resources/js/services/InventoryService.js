import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class InventoryService {
    constructor() {}

    static getInventory(stationid) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/inventories/allProducts/' + stationid)
                .then(result => {
                    resolve(result)
                })
                .catch(error => console.error(error))
        })
    }
}
