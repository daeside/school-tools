function createIcon(type, url) {
  const icon = document.createElement('i');
  icon.classList.add('material-icons');
  icon.innerText = type;
  const urlElement = document.createElement('a');
  urlElement.setAttribute('href', url);
  urlElement.appendChild(icon);
  return urlElement;
}

async function deleteElement(url, name) {
  let deleteElement = confirm('¿Desea borrar ' + name + '?');
  if (!deleteElement) {
    return;
  }
  try {
    const response = await axios.delete(url);
    if (response.status === 204) {
      alert('Se ha borrado correctamente el elemento');
      location.reload();
      return;
    }
    alert('Error al borrar elemento');
    console.log(response);
  } catch (error) {
    console.log('Ha ocurrido un error: ', error);
  }
}