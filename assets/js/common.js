/* global requestAnimationFrame, getComputedStyle, CustomEvent */

export default class Common {
  addClass (element, className) {
    if (element.classList) {
      element.classList.add(className)
    } else {
      element.className += ' ' + className
    }
  }

  removeClass (element, className) {
    if (element.classList) {
      element.classList.remove(className)
    } else {
      element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ')
    }
  }

  hasClass (element, className) {
    if (element.classList) {
      return element.classList.contains(className)
    } else {
      return new RegExp('(^| )' + className + '( |$)', 'gi').test(element.className)
    }
  }

  toggleClass (element, className) {
    if (element.classList) {
      element.classList.toggle(className)
    } else {
      var classes = element.className.split(' ')
      var existingIndex = classes.indexOf(className)

      if (existingIndex >= 0) {
        classes.splice(existingIndex, 1)
      } else {
        classes.push(className)
      }

      element.className = classes.join(' ')
    }
  }

  fadeIn (element) {
    element.style.opacity = 0

    let last = +new Date()
    const tick = () => {
      element.style.opacity = +element.style.opacity + (new Date() - last) / 400
      last = +new Date()

      if (+element.style.opacity < 1) {
        (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
      }
    }

    tick()
  }

  offset (element) {
    const rect = element.getBoundingClientRect()

    return {
      top: rect.top + document.body.scrollTop,
      left: rect.left + document.body.scrollLeft
    }
  }

  outerHeight (element) {
    let height = element.offsetHeight
    const style = getComputedStyle(element)

    height += parseInt(style.marginTop) + parseInt(style.marginBottom)
    return height
  }

  outerWidth (element) {
    let width = element.offsetWidth
    const style = getComputedStyle(element)

    width += parseInt(style.marginLeft) + parseInt(style.marginRight)
    return width
  }

  triggerEvent (element, eventName, data) {
    let event = null
    if (window.CustomEvent) {
      event = new CustomEvent(eventName, { detail: data })
    } else {
      event = document.createEvent('CustomEvent')
      event.initCustomEvent(eventName, true, true, data)
    }

    element.dispatchEvent(event)
  }
}
