function h_blake3(data) {
    return utils.bytesToHex(blake3(data))
}