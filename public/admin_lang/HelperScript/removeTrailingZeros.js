
function removeTrailingZeros(number) {
    return parseFloat(number).toFixed(2).replace(/\.?0+$/, '');
  }