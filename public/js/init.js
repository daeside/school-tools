function createIcon(type, url) {
  const icon = document.createElement('i');
  icon.classList.add('material-icons');
  icon.innerText = type;
  const urlElement = document.createElement('a');
  urlElement.setAttribute('href', url);
  urlElement.appendChild(icon);
  return urlElement;
}
