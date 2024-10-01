function createActions(url) {
  const actionsContainer = document.createElement('div');
  const editUrl = createIcon('edit', url, '#198754');
  const deleteUrl = createIcon('delete', url, '#dc3545');
  actionsContainer.appendChild(editUrl);
  actionsContainer.appendChild(deleteUrl);
  return actionsContainer.outerHTML;
}

function createIcon(type, url, color) {
  const icon = document.createElement('i');
  icon.classList.add('material-icons');
  icon.setAttribute('style', 'color: ' + color);
  icon.innerText = type;
  const urlElement = document.createElement('a');
  urlElement.setAttribute('href', url);
  urlElement.appendChild(icon);
  return urlElement;
}
