import Helper from '../helper/Helper'

export default class ApiService {
    constructor() {
        this.tokenEl = document.querySelectorAll('meta[name="csrf-token')[0]
        this.csrfToekn = Helper.getAllAttributesFromTag(this.tokenEl).content
    }

    static getInstance() {
        if (!this.instance) {
            this.instance = new ApiService()
        }
        return this.instance
    }

    header() {
        return {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': this.csrfToekn
        }
    }

    get(url) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                headers: this.header(),
                method: 'GET'
            })
                .then(response => {
                    if (response.status === 200) {
                        return response.json()
                    }
                    throw new Error(`Server Error, status: ${response.status}`)
                })
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                    console.log(error)
                })
        })
    }

    post(url, data) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                headers: this.header(),
                method: 'POST',
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.status === 200) {
                        return response.json()
                    }
                    throw new Error(`Server Error, status: ${response.status}`)
                })
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                    console.log(error)
                })
        })
    }

    put(url, id, data) {
        return new Promise((resolve, reject) => {
            fetch(url + '/' + id, {
                headers: this.header(),
                method: 'PUT',
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.status === 200) {
                        return response.json()
                    }
                    throw new Error(`Server Error, status: ${response.status}`)
                })
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                    console.log(error)
                })
        })
    }

    delete(url, id) {
        return new Promise((resolve, reject) => {
            fetch(url + '/' + id, {
                headers: this.header(),
                method: 'DELETE'
            })
                .then(response => {
                    if (response.status === 200) {
                        return response.json()
                    }
                    throw new Error(`Server Error, status: ${response.status}`)
                })
                .then(response => {
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                    console.log(error)
                })
        })
    }
}
