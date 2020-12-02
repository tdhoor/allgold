import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'

export default class InventoryService {
    constructor() {}

    static getInventory(stationid) {
        console.log(SERVER_URL + 'api/inventories/allProducts/' + stationid)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/inventories/allProducts/' + stationid)
                .then(response => {
                    console.log(response.data)
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => reject(error))
        })
    }
}
