import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'
import Inventory from '../utils/Inventory'

export default class InventoryService {
    constructor() {}

    static getInventory(stationid) {
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

    static update(inventory) {
        let newInventory = new Inventory(inventory)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .put(
                    SERVER_URL + 'api/inventories',
                    inventory.inventoryId,
                    newInventory.toJSON()
                )
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    }
                })
                .catch(error => console.log(error))
        })
    }

    static getRefill() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/inventories/refillProducts')
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => console.log(error))
        })
    }
}
