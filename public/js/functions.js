function createIcon(type) {
  const icon = document.createElement('i');
  icon.classList.add('material-icons');
  icon.innerText = type;
  const urlElement = document.createElement('a');
  urlElement.setAttribute('href', '#');
  urlElement.appendChild(icon);
  return urlElement;
}

async function getElement(url, token) {
  try {
    const response = await axios.get(url, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    return response.data;
  } catch (error) {
    console.log('Ha ocurrido un error: ', error);
  }
}

async function deleteElement(url, name, token) {
  let deleteElement = confirm('¿Desea borrar ' + name + '?');
  if (!deleteElement) {
    return;
  }
  try {
    const response = await axios.delete(url, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    if (response.status === 204) {
      alert('Se ha borrado correctamente el elemento');
      location.reload();
      return;
    }
    alert('Error al borrar elemento');
  } catch (error) {
    console.log('Ha ocurrido un error: ', error);
  }
}