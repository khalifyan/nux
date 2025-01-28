import request from '../utils/request'

export function view(link, data) {
    return request({
        url: `link/${link}/view`,
        method: 'post',
        data
    })
}

export function generate(link, data) {
    return request({
        url: `link/${link}/generate`,
        method: 'post',
        data
    })
}

export function deactivate(link, data) {
    return request({
        url: `link/${link}/deactivate`,
        method: 'post',
        data
    })
}

export function play(link, data) {
    return request({
        url: `win/${link}/lucky`,
        method: 'post',
        data
    })
}

export function getHistory(link, data) {
    return request({
        url: `win/${link}/history`,
        method: 'post',
        data
    })
}
