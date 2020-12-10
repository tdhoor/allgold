import { SERVER_URL } from '../server/Server'
import ApiService from '../services/ApiService'
import Product from '../utils/Product'

export default class ProductService {
    constructor() {}

    static getAll() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/products')
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => reject(error))
        })
    }

    static getOne(productId) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'api/products/' + productId)
                .then(response => {
                    if (response.status === 200) {
                        resolve(response.data)
                    }
                })
                .catch(error => reject(error))
        })
    }

    static update(product) {
        let newProduct = new Product(product)
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .put(
                    SERVER_URL + 'api/products',
                    newProduct.productId,
                    newProduct.toJSON()
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
