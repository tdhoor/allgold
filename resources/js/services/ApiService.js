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

    get(url) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToekn
                },
                method: 'GET'
            })
                .then(response => {
                    if (response.status === 200) return response.json()
                    throw new Error(
                        'Something went wrong on RestService.get()!'
                    )
                })
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    }

    post(url, data) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToekn
                },
                method: 'POST',
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.status === 200) return response.json()
                    throw new Error(
                        'Something went wrong on RestService.post()!'
                    )
                })
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    }

    put(url, id, data) {
        return new Promise((resolve, reject) => {
            fetch(url + '/' + id, {
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToekn
                },
                method: 'PUT',
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.status === 200) return response.json()
                    throw new Error(
                        'Something went wrong on RestService.put()!'
                    )
                })
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    }

    delete(url, id) {
        return new Promise((resolve, reject) => {
            fetch(url + '/' + id, {
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToekn
                },
                method: 'DELETE',
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (response.status === 200) return response.json()
                    throw new Error(
                        'Something went wrong on RestService.delete()!'
                    )
                })
                .then(response => resolve(response))
                .catch(error => reject(error))
        })
    }
}
