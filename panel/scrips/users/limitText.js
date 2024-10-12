document.querySelectorAll('.limit-text').forEach(function (cell) {
    let maxLength = 30;
    if (cell.innerText.length > maxLength) {
      cell.innerText = cell.innerText.slice(0, maxLength) + '...';
    }
  });