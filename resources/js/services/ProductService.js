import { SERVER_URL } from '../server/Server';
import ApiService from '../service/ApiService';

export default class ProductService {
    constructor() {}

    store(sale) {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .post(SERVER_URL + 'verkauf/store', sale)
                .then(result => {
                    if (result) {
                        resolve(true);
                    }
                    resolve(false);
                })
                .catch(error => console.error(error));
        });
    }

    getNewKey() {
        return new Promise((resolve, reject) => {
            ApiService.getInstance()
                .get(SERVER_URL + 'verkauf/getNewID')
                .then(result => {
                    resolve(result.saleid);
                })
                .catch(error => console.error(error));
        });
    }
}
