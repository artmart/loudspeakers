class DropdownMultiple extends EventTarget {
  constructor (div, nb = 15) {
    super()
    this.div         = div
    this.symbol      = div.dataset.dropdown
    this.selected    = div.querySelector('.selected')
    this.menu        = div.querySelector('.menu')
    this.input       = div.querySelector('input.filter')
    this.placeholder = div.querySelector('.placeholder')
    this.open        = false
    this.menu_height = this.calculate_menu_height(nb)
    this.add_event_listeners()
  }

  calculate_menu_height(nb) {
    let span_height = this.menu.querySelector('span').scrollHeight
    log(span_height)
    let menu_style  = window.getComputedStyle(this.menu)
    let menu_height = nb * span_height + 
      parseFloat(menu_style["borderTopWidth"]) +
      parseFloat(menu_style["borderBottomWidth"]) + 3
    
    return menu_height
  }

  add_event_listeners () {
    this.menu.css('span').forEach((span) => {
      span.addEventListener('click', () => {
        this.select(span)
      })
    })
    this.input.addEventListener('keyup', (event) => {
      switch (event.key) {
        case 'ArrowDown':
        break
        case 'ArrowUp':
          event.preventDefault()
        break
        case 'Enter':
        break
        case 'Escape':
        break
        default:
          this.filter(this.input.value)
          this.focus_first()
      }
    })
    this.input.addEventListener('keydown', (event) => {
      switch (event.key) {
        case 'ArrowUp':
          event.preventDefault()
        break
      }
    })
    this.div.addEventListener('keydown', (event) => {
      switch (event.key) {
        case 'Backspace': 
          if (this.input.value == '') { this.delete_last() }
        break 
        case 'ArrowDown': 
          this.focus_next() 
        break
        case 'ArrowUp': 
          this.focus_previous() 
        break
        case 'Enter': 
          if (!this.select_focused() ) {
            // close the menue if no element is focused
            this.close_menu()
          }
        break
        case 'Escape': 
          this.close_menu() 
        break
        case 'Tab': 
          this.close_menu() 
        break
      }
    })
    document.addEventListener('click', (event) => {
      if (event.composedPath().includes(this.div)) {
        // console.log('Clicked inside the div')
        this.open_menu()
        this.input.focus()
      } else {
        // console.log('Clicked outside the Dropdown')
        this.close_menu()
      }
    })
    this.input.addEventListener("focus", (event) => {
      // log("div focus")
      this.open_menu()
    })
  }


  select(item) {
    if (this.menu.querySelector('span.focus') == item) {
      this.focus_next()
    }
    let clone = item.cloneNode(true)
    this.selected.appendChild(clone)
    clone.addEventListener('click', () => {
      this.delete(clone)
    })
    item.classList.add("selected")
    // this.clear_filter()
    this.clear_garbage_focus()
    this.dispatchEvent(new Event('modified'))
  }

  delete(item) {
    let key = item.getAttribute("value")
    let menu_item = this.menu.querySelector('span[value="'+key+'"]')
    menu_item.classList.remove("selected")
    item.parentNode.removeChild(item)
    this.remove_focus()
    menu_item.classList.add("focus")
    this.scroll_to_focused()
    this.dispatchEvent(new Event('modified'))
  }

  delete_last() {
    let selected_values = this.get_selected_values()
    if (1 <= selected_values.length) {
      let last_value = selected_values.last()
      let last_item = this.selected.querySelector('span[value="'+last_value+'"]')
      this.delete(last_item)
    }
  }

  get_all_values() {
    let array = []
    this.menu.css('span').forEach(span => {
      let value = span.getAttribute("value")
      if (value) { array.push(value) }
    })
    return array
  }  

  get_selected_values() {
    let array = []
    this.selected.css('span').forEach(span => {
      let value = span.getAttribute("value")
      if (value) { array.push(value) }
    })
    return array
  }

  set_selected_values(values) {
    if (values && 0 < values.length) {
      this.remove_placeholder()
      values.forEach(v => {
        this.menu.css('span').forEach(span => {
          if (v == span.getAttribute("value")) {
            this.select(span)
          }
        })
      })
    }
  }

  clear_selected_values() {
    this.selected.css('span').forEach(span => {
      this.delete(span)
    })
  }


  filter(string) {
    let regex = new RegExp(string, "i");
    this.menu.css('span').forEach(span => {
      let value = span.getAttribute("value")
      let text = span.innerHTML
      if (regex.test(value) || regex.test(text)) {
        span.classList.remove("hide")
      } else {
        span.classList.add("hide")
      }
    })
    this.scroll_to_focused()
  }

  clear_filter() {
    this.input.value = ""
    this.menu.css('span').forEach(span => {
      span.classList.remove("hide")
    })
  }

  add_placeholder() {
    if (this.get_selected_values().length == 0) {
      this.placeholder.classList.remove("hide")
    }
  }

  remove_placeholder() {
    this.placeholder.classList.add("hide")
  }

  open_menu() {
    if (!this.open) {
      this.menu.classList.add("open")
      this.menu.style["max-height"] = this.menu_height + "px"
      this.remove_placeholder()
      this.open = true
      this.div.classList.add("active")
      setTimeout(()=> { // Waite for the menu to open
        this.scroll_to_focused()        
      }, 300)
    }
  }

  close_menu() {
    if (this.open) {
      this.dispatchEvent(new Event('close'))
      this.menu.classList.remove("open")
      this.menu.style["max-height"] = "0px"
      this.input.blur()
      this.open = false
      this.div.classList.remove("active")
      this.add_placeholder()
      let timeout = this.input.value == '' ? 0 : 200 // ms
      setTimeout(()=> { // Waite for the menu to close
        this.clear_filter()
      }, timeout)
    }
  }

  focus_first() {
    this.clear_garbage_focus()
    if (!this.menu.querySelector('span.focus')) {
      this.remove_focus()
      this.menu.querySelector('span:not(.selected, .hide)').classList.add("focus")
      this.scroll_to_focused()
    }
  }

  focus_last() {
    this.clear_garbage_focus()
    if (!this.menu.querySelector('span.focus')) {
      this.remove_focus()
      this.menu.css('span:not(.selected, .hide)').last().classList.add("focus")
      this.scroll_to_focused()
    }
  }

  focus_next() {
    if (!this.menu.querySelector('span.focus')) {
      this.focus_first()
    } else {
      let next = false
      let all_spans = this.menu.css('span:not(.selected, .hide)')
      let last_span = all_spans.last()
      all_spans.forEach(span => {
        if (span.classList.contains('focus')) {
          span.classList.remove('focus')
          if (span != last_span) {
            next = true
          } else {
            this.focus_first()
          }
        } else if (next) {
          span.classList.add('focus')
          next = false
        }
      })
      this.scroll_to_focused()
    }
  }

  focus_previous() {
    let all_spans_NodeList = this.menu.css('span:not(.selected, .hide)')
    let all_spans = []
    all_spans_NodeList.forEach(span => {
      all_spans.unshift(span)
    })
    if (!this.menu.querySelector('span.focus')) {
      all_spans.first().classList.add('focus')
    } else {
      let next = false
      let last_span = all_spans.last()
      all_spans.forEach(span => {
        if (span.classList.contains('focus')) {
          span.classList.remove('focus')
          if (span != last_span) {
            next = true
          } else {
            this.focus_last()
          }
        } else if (next) {
          span.classList.add('focus')
          next = false
        }
      })
      this.scroll_to_focused()
    }
  }

  remove_focus() {
    this.menu.css('span').forEach(span => {
      span.classList.remove('focus')
    })
  }
  
  clear_garbage_focus() {
    this.menu.css('span.selected, span.hide').forEach(span => {
      span.classList.remove('focus')
    })
  }

  select_focused() {
    let focused = this.menu.querySelector('span.focus')
    if (focused) {
      this.select(focused)
      return true
    } else {
      return false
    }
  }

  scroll_to_focused() {
    let focused = this.menu.querySelector('span.focus')
    if (focused) {
      // Position of the focused element from the top
      let focused_position = focused.offsetTop
      let focused_height   = focused.offsetHeight
      let scroll_position  = this.menu.scrollTop
      let menu_style       = window.getComputedStyle(this.menu)
      let menu_height      = this.menu.offsetHeight - 
        parseFloat(menu_style["borderTopWidth"]) -
        parseFloat(menu_style["borderBottomWidth"])
      // Test if the element is outside the visible part of the menu
      if (focused_position < scroll_position) {
        // log("Over the visible part of the menu")
        this.menu.scrollTop = focused_position - 1
      } else if ((scroll_position + menu_height) < (focused_position + focused_height)) {
        // log("Lower the visible part of the menu")
        this.menu.scrollTop = focused_position + focused_height - menu_height + 1
      }
    }
  }

}



document.addEventListener('DOMContentLoaded', (event) => {
  document.css('.dropdown.multiple').forEach((div) => {
    if (!div.dropdown) {
      div.dropdown = new DropdownMultiple(div)
      // div.dropdown.addEventListener('close', () => console.log(div.dropdown.get_selected_values()))
    }
  })
});