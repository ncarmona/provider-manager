window.onload = () => {
   setTimeout(() => {
    Array.from(document.getElementsByClassName('alert'))
        .forEach(e => e.classList.add('d-none'))
   }, 3000)
} 