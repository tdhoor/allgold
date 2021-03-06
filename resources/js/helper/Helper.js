import Station from '../utils/Station'

export default class Helper {
    static getAllAttributesFromTag(el) {
        let attributes = {}
        for (let i = 0, atts = el.attributes, n = atts.length; i < n; i++) {
            let nodeName = atts[i].nodeName
            let nodeValue = atts[i].nodeValue
            if (nodeName !== 'href' && nodeName !== 'class') {
                attributes[nodeName] = nodeValue
            }
        }
        return attributes
    }

    static parseStringToFloatNumber(el) {
        return parseFloat(el).toFixed(2)
    }

    static getStationDummy() {
        return new Station({
            location: null,
            coordsA: null,
            coordsB: null,
            type: null,
            description: null
        })
    }
}
