const tableOfContents = document.querySelector('.toc')
// console.log(tableOfContents)
if (tableOfContents) {
  const headers = [].slice.call(document.querySelectorAll('.anchor'))
    .map(({ name, offsetTop: position }) => ({ name, position }))
    .reverse()

  highlightLink(headers[headers.length - 1].id)

  window.addEventListener('scroll', _event => {
    const position = (document.documentElement.scrollTop || document.body.scrollTop) + 34
    const current = headers.filter(header => header.position < position)[0] || headers[headers.length - 1]
    const active = document.querySelector('.toc .active')

    if (active) {
      active.classList.remove('active')
    }

    highlightLink(current.name)
  })
}

function highlightLink (name) {
  const highlight = document.querySelector(`.toc a[href="#${name}"]`)

  if (highlight) {
    highlight.parentNode.classList.add('active')
  }
}
